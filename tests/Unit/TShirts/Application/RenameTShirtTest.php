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
use JacoBaldrich\TShirt\TShirts\Domain\TShirt;
use JacoBaldrich\TShirt\Shared\UuidValueObject;
use JacoBaldrich\TShirt\TShirts\Domain\TShirtName;
use JacoBaldrich\TShirt\Tests\Unit\Shared\TestBase;
use JacoBaldrich\TShirt\TShirts\Application\TShirtCreator;
use JacoBaldrich\TShirt\TShirts\Application\TShirtRemover;
use JacoBaldrich\TShirt\TShirts\Application\TShirtRenamer;
use JacoBaldrich\TShirt\TShirts\Application\CreateTShirtCommand;
use JacoBaldrich\TShirt\TShirts\Application\RemoveTShirtCommand;
use JacoBaldrich\TShirt\TShirts\Application\RenameTShirtCommand;
use JacoBaldrich\TShirt\TShirts\Application\CreateTShirtCommandHandler;
use JacoBaldrich\TShirt\TShirts\Application\RemoveTShirtCommandHandler;
use JacoBaldrich\TShirt\TShirts\Application\RenameTShirtCommandHandler;
use JacoBaldrich\TShirt\TShirts\Infrastructure\InMemoryTShirtRepository;

/**
 * Tests for T-shirt use cases.
 */
final class RenameTShirtTest extends TestBase
{
	private $id = '25769c6c-d34d-4bfe-ba98-e0ee856f3e7a';
	private $name = 'Camiseta de manga corta';
	protected function setUp(): void
	{
		parent::setUp();
		$this->repository = new InMemoryTShirtRepository;
	}

	public function test_create_a_new_tshirt()
	{
		// Given:
		$tShirt = new TShirt(
			new TShirtId( $this->id ),
			new TShirtName( $this->name )
		);
		$creator = new TShirtCreator( $this->repository );
		$handler = new CreateTShirtCommandHandler( $creator );
		$command = new CreateTShirtCommand(
			new UuidValueObject,
			$this->id,
			$this->name
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
	 * @depends test_create_a_new_tshirt
	 */
	public function test_rename_a_tshirt( $repository )
	{
		// Given:
		$newName = 'Camiseta de manga larga';
		$tShirt = new TShirt(
			new TShirtId( $this->id ),
			new TShirtName( $newName )
		);
		$renamer = new TShirtRenamer( $repository );
		$handler = new RenameTShirtCommandHandler( $renamer );
		$command = new RenameTShirtCommand(
			new UuidValueObject,
			$this->id,
			$newName
		);
		// When:
		$handler->handle( $command );
		$actualTShirt = $repository->find( new TShirtId( $this->id ) );
		$tShirt->pullDomainEvents();
		$actualTShirt->pullDomainEvents();
		// Then:
		$this->assertEquals(
			$tShirt,
			$repository->find( new TShirtId( $this->id ) )
		);
	}
}
