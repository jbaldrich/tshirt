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
use JacoBaldrich\TShirt\TShirts\Domain\TShirtName;
use JacoBaldrich\TShirt\Tests\Unit\Shared\TestBase;
use JacoBaldrich\TShirt\TShirts\Domain\TShirtRepository;
use JacoBaldrich\TShirt\TShirts\Application\TShirtRenamer;
use JacoBaldrich\TShirt\TShirts\Application\RenameTShirtCommand;
use JacoBaldrich\TShirt\TShirts\Application\RenameTShirtCommandHandler;

/**
 * Tests for rename a T-shirt use case.
 */
final class RenameTShirtTest extends TestBase
{
	private $repository;
	private $renamer;
	private $handler;

	protected function setUp(): void
	{
		parent::setUp();
		$this->repository = $this->mock( TShirtRepository::class );
		$this->renamer = new TShirtRenamer( $this->repository );
		$this->handler = new RenameTShirtCommandHandler( $this->renamer );
	}

	public function test_renames_a_tshirt()
	{
		$tShirt = new TShirt(
			new TShirtId( '25769c6c-d34d-4bfe-ba98-e0ee856f3e7a' ),
			new TShirtName( 'Camiseta de manga larga' )
		);
		$this->repository->expects()
			->save( $this->anInstanceOf( TShirt::class ) )
			->andReturn();
		$this->repository->save( $tShirt );

		$command = new RenameTShirtCommand(
			new UuidValueObject,
			'25769c6c-d34d-4bfe-ba98-e0ee856f3e7a',
			'Camiseta de manga corta'
		);

		$this->repository->expects()
			->find( $this->anInstanceOf( TShirtId::class ) )
			->andReturnNull();

		/* $this->repository->expects()
			->save( $this->anInstanceOf( TShirt::class ) )
			->andReturn(); */

		$this->handler->handle( $command );
	}
}
