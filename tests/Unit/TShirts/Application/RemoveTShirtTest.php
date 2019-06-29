<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\Tests\Unit\TShirts\Application;

use JacoBaldrich\TShirt\Shared\TShirtId;
use JacoBaldrich\TShirt\TShirts\Domain\TShirt;
use JacoBaldrich\TShirt\Shared\UuidValueObject;
use JacoBaldrich\TShirt\Tests\Unit\Shared\TestBase;
use JacoBaldrich\TShirt\TShirts\Domain\TShirtRepository;
use JacoBaldrich\TShirt\TShirts\Application\TShirtCreator;
use JacoBaldrich\TShirt\TShirts\Application\TShirtRemover;
use JacoBaldrich\TShirt\TShirts\Application\CreateTShirtCommand;
use JacoBaldrich\TShirt\TShirts\Application\RemoveTShirtCommand;
use JacoBaldrich\TShirt\TShirts\Application\CreateTShirtCommandHandler;
use JacoBaldrich\TShirt\TShirts\Application\RemoveTShirtCommandHandler;
use JacoBaldrich\TShirt\TShirts\Infrastructure\InMemoryTShirtRepository;

/**
 * Tests for remove a T-shirt use case.
 */
final class RemoveTShirtTest extends TestBase
{
	private $repository;
	private $remover;
	private $handler;

	protected function setUp(): void
	{
		parent::setUp();
		$this->repository = $this->mock( TShirtRepository::class );
		$this->remover = new TShirtRemover( $this->repository );
		$this->handler = new RemoveTShirtCommandHandler( $this->remover );
	}

	public function test_throws_an_exception_when_trying_to_remove_a_non_existing_tshirt()
	{
		$command = new RemoveTShirtCommand(
			new UuidValueObject,
			'25769c6c-d34d-4bfe-ba98-e0ee856f3e7a',
			'name'
		);

		$this->repository->expects()
			->find( $this->anInstanceOf( TShirtId::class ) )
			->andReturn();
		$this->expectException(\Exception::class);

		$this->handler->handle( $command );
	}

	public function test_removes_a_tshirt()
	{
		// Ensure product is created.
		$productId = '25769c6c-d34d-4bfe-ba98-e0ee856f3e7a';
		$repository = new InMemoryTShirtRepository;
		$creator = new TShirtCreator( $repository );
		$creatorHandler = new CreateTShirtCommandHandler( $creator );
		$createCommand = new CreateTShirtCommand(
			new UuidValueObject,
			$productId,
			'Camiseta de manga corta'
		);
		$creatorHandler->handle( $createCommand );

		// Test removing:
		// Given:
		$remover = new TShirtRemover( $repository );
		$handler = new RemoveTShirtCommandHandler( $remover );
		$command = new RemoveTShirtCommand(
			new UuidValueObject,
			$productId
		);
		// When:
		$handler->handle( $command );
		// Then:
		$this->assertFalse(
			array_key_exists(
				$productId,
				$repository
			)
		);
	}
}
