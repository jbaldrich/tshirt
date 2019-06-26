<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\Tests\Unit\TShirts\Application;

use JacoBaldrich\TShirt\Shared\UuidValueObject;
use JacoBaldrich\TShirt\Variants\Domain\Variant;
use JacoBaldrich\TShirt\Tests\Unit\Shared\TestBase;
use JacoBaldrich\TShirt\Variants\Domain\VariantRepository;
use JacoBaldrich\TShirt\Variants\Application\VariantCreator;
use JacoBaldrich\TShirt\Variants\Application\CreateVariantCommand;
use JacoBaldrich\TShirt\Variants\Application\CreateVariantCommandHandler;

/**
 * Tests for create a Variant use case.
 */
final class CreateVariantTest extends TestBase
{
	private $repository;
	private $creator;
	private $handler;

	protected function setUp(): void
	{
		parent::setUp();
		$this->repository = $this->mock( VariantRepository::class );
		$this->creator = new VariantCreator( $this->repository );
		$this->handler = new CreateVariantCommandHandler( $this->creator );
	}

	public function test_creates_a_variant()
	{
		$command = new CreateVariantCommand(
			new UuidValueObject,
			'25769c6c-d34d-4bfe-ba98-e0ee856f3e7a',
			'e4eaaaf2-d142-11e1-b3e4-080027620cdd',
			'M',
			1495,
			1095
		);

		$this->repository->expects()
			->save( $this->anInstanceOf( Variant::class ) )
			->andReturn();

		$this->handler->handle( $command );
	}

	public function test_creates_a_variant_without_offer_price()
	{
		$command = new CreateVariantCommand(
			new UuidValueObject,
			'25769c6c-d34d-4bfe-ba98-e0ee856f3e7a',
			'e4eaaaf2-d142-11e1-b3e4-080027620cdd',
			'M',
			1495
		);

		$this->repository->expects()
			->save( $this->anInstanceOf( Variant::class ) )
			->andReturn();

		$this->handler->handle( $command );
	}
}
