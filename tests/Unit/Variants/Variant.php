<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\Tests\Unit\TShirts;

use JacoBaldrich\TShirt\Shared\TShirtId;
use JacoBaldrich\TShirt\Shared\VariantId;
use JacoBaldrich\TShirt\Shared\VariantPrice;
use JacoBaldrich\TShirt\Shared\UuidValueObject;
use JacoBaldrich\TShirt\Variants\Domain\Variant;
use JacoBaldrich\TShirt\Tests\Unit\Shared\TestBase;
use JacoBaldrich\TShirt\Variants\Domain\VariantSize;
use JacoBaldrich\TShirt\Variants\Application\PriceChanger;
use JacoBaldrich\TShirt\Variants\Application\VariantRemover;
use JacoBaldrich\TShirt\Variants\Application\VariantCreator;
use JacoBaldrich\TShirt\Variants\Application\ChangePriceCommand;
use JacoBaldrich\TShirt\Variants\Application\RemoveVariantCommand;
use JacoBaldrich\TShirt\Variants\Application\CreateVariantCommand;
use JacoBaldrich\TShirt\Variants\Domain\InMemoryVariantRepository;
use JacoBaldrich\TShirt\Variants\Application\ChangeOfferPriceCommand;
use JacoBaldrich\TShirt\Variants\Application\ChangePriceCommandHandler;
use JacoBaldrich\TShirt\Variants\Application\RemoveVariantCommandHandler;
use JacoBaldrich\TShirt\Variants\Application\CreateVariantCommandHandler;
use JacoBaldrich\TShirt\Variants\Application\ChangeOfferPriceCommandHandler;
use JacoBaldrich\TShirt\Shared\VariantPriceChanged;

/**
 * Tests for variant use cases.
 */
final class VariantTest extends TestBase
{
	private $tShirtId = '25769c6c-d34d-4bfe-ba98-e0ee856f3e7a';
	private $id = 'e4eaaaf2-d142-11e1-b3e4-080027620cdd';
	private $size = 'M';
	private $price = 1995;
	private $offerPrice = 1495;

	protected function setUp(): void
	{
		parent::setUp();
		$this->repository = new InMemoryVariantRepository;
	}

	public function test_create_a_new_variant()
	{
		// Given:
		$variant = new Variant(
			new TShirtId( $this->tShirtId ),
			new VariantId( $this->id ),
			new VariantSize( $this->size ),
			new VariantPrice( $this->price ),
			new VariantPrice( $this->offerPrice )
		);
		$creator = new VariantCreator( $this->repository );
		$handler = new CreateVariantCommandHandler( $creator );
		$command = new CreateVariantCommand(
			new UuidValueObject,
			$this->tShirtId,
			$this->id,
			$this->size,
			$this->price,
			$this->offerPrice
		);
		// When:
		$handler->handle( $command );
		// Then:
		$this->assertEquals(
			$variant,
			$this->repository->find( new VariantId( $this->id ) )
		);
		return $this->repository;
	}

	/**
	 * @depends test_create_a_new_variant
	 */
	public function test_change_a_price( $repository )
	{
		// Given:
		$newPrice = 2195;
		$variant = new Variant(
			new TShirtId( $this->tShirtId ),
			new VariantId( $this->id ),
			new VariantSize( $this->size ),
			new VariantPrice( $newPrice ),
			new VariantPrice( $this->offerPrice )
		);
		$priceChanger = new PriceChanger( $repository );
		$handler = new ChangePriceCommandHandler( $priceChanger );
		$command = new ChangePriceCommand(
			new UuidValueObject,
			$this->id,
			$newPrice
		);
		// When:
		$handler->handle( $command );
		$actualVariant = $repository->find( new VariantId( $this->id ) );
		$events = $actualVariant->pullDomainEvents();
		// Then:
		$this->assertEquals(
			$events,
			[
				new VariantPriceChanged(
					$this->tShirtId,
					$this->id,
					(string) $this->offerPrice,
					10000 - (int) round(
						$this->offerPrice / $newPrice * 10000,
						2
					)
				)
			]
		);
		$this->assertEquals(
			$variant,
			$actualVariant
		);
		$this->tearDown();
	}

	/**
	 * @depends test_create_a_new_variant
	 */
	public function test_change_an_offer_price( $repository )
	{
		// Given:
		$newPrice = 1395;
		$variant = new Variant(
			new TShirtId( $this->tShirtId ),
			new VariantId( $this->id ),
			new VariantSize( $this->size ),
			new VariantPrice( 2195 ),
			new VariantPrice( $newPrice )
		);
		$priceChanger = new PriceChanger( $repository );
		$handler = new ChangeOfferPriceCommandHandler( $priceChanger );
		$command = new ChangeOfferPriceCommand(
			new UuidValueObject,
			$this->id,
			$newPrice
		);
		// When:
		$handler->handle( $command );
		$actualVariant = $repository->find( new VariantId( $this->id ) );
		$events = $actualVariant->pullDomainEvents();
		// Then:
		$this->assertEquals(
			$events,
			[
				new VariantPriceChanged(
					$this->tShirtId,
					$this->id,
					(string) $this->offerPrice,
					10000 - (int) round(
						$this->offerPrice / $newPrice * 10000,
						2
					)
				)
			]
		);
		$this->assertEquals(
			$variant,
			$actualVariant
		);
	}

	/**
	 * @depends test_create_a_new_variant
	 */
	public function test_remove_a_variant( $repository )
	{
		// Given:
		$remover = new VariantRemover( $repository );
		$handler = new RemoveVariantCommandHandler( $remover );
		$command = new RemoveVariantCommand(
			new UuidValueObject,
			$this->id
		);
		// When:
		$handler->handle( $command );
		// Then:
		$this->assertFalse(
			array_key_exists(
				$this->id,
				$repository
			)
		);
	}
}