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
use JacoBaldrich\TShirt\Variants\Application\VariantCreator;
use JacoBaldrich\TShirt\Variants\Application\CreateVariantCommand;
use JacoBaldrich\TShirt\Variants\Domain\InMemoryVariantRepository;
use JacoBaldrich\TShirt\Variants\Application\ChangeOfferPriceCommand;
use JacoBaldrich\TShirt\Variants\Application\CreateVariantCommandHandler;
use JacoBaldrich\TShirt\Variants\Application\ChangeOfferPriceCommandHandler;

/**
 * Tests for change variant offer price use case.
 */
final class ChangeVariantOfferPriceTest extends TestBase
{
	private $id = '25769c6c-d34d-4bfe-ba98-e0ee856f3e7a';
	private $price = 1000;
	protected function setUp(): void
	{
		parent::setUp();
		$this->repository = new InMemoryVariantRepository;
	}

	public function test_create_a_new_variant()
	{
		// Given:
		$creator = new VariantCreator( $this->repository );
		$handler = new CreateVariantCommandHandler( $creator );
		$command = new CreateVariantCommand(
			new UuidValueObject,
			'25769c6c-d34d-4bfe-ba98-e0ee856f3e7a',
			$this->id,
			'M',
			2000,
			$this->price
		);
		// When:
		$handler->handle( $command );
		// Then:
		$this->assertTrue(
			array_key_exists(
				$this->id,
				$this->repository
			)
		);
		return $this->repository;
	}

	/**
	 * @depends test_create_a_new_variant
	 */
	public function test_change_a_variant_offer_price( $repository )
	{
		// Given:
		$newPrice = 999;
		$variant = new Variant(
			new TShirtId( '25769c6c-d34d-4bfe-ba98-e0ee856f3e7a' ),
			new VariantId( $this->id ),
			new VariantSize( 'M' ),
			new VariantPrice( 2000 ),
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
		$variant->pullDomainEvents();
		$actualVariant->pullDomainEvents();
		// Then:
		$this->assertEquals(
			$variant,
			$repository->find( new VariantId( $this->id ) )
		);
	}
}
