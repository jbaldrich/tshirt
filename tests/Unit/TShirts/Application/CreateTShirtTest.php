<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\Tests\Unit\TShirts\Application;

use JacoBaldrich\TShirt\Tests\Unit\Shared\TestBase;
use JacoBaldrich\TShirt\Shared\UuidValueObject;
use JacoBaldrich\TShirt\TShirts\Domain\TShirtRepository;
use JacoBaldrich\TShirt\TShirts\Application\TShirtCreator;
use JacoBaldrich\TShirt\TShirts\Application\CreateTShirtCommand;
use JacoBaldrich\TShirt\TShirts\Application\CreateTShirtCommandHandler;
use JacoBaldrich\TShirt\TShirts\Domain\TShirt;

/**
 * Tests for create a T-shirt use case.
 */
final class CreateTShirtTest extends TestBase
{
	private $repository;
	private $creator;
	private $handler;

	protected function setUp(): void
	{
		parent::setUp();
		$this->repository = $this->mock( TShirtRepository::class );
		$this->creator = new TShirtCreator( $this->repository );
		$this->handler = new CreateTShirtCommandHandler( $this->creator );
	}

	public function test_creates_a_tshirt()
	{
		$command = new CreateTShirtCommand(
			new UuidValueObject,
			'25769c6c-d34d-4bfe-ba98-e0ee856f3e7a',
			'Camiseta de manga corta'
		);

		$this->repository->expects()
			->save( $this->anInstanceOf( TShirt::class ) )
			->andReturn();

		$this->handler->handle( $command );
	}
}
