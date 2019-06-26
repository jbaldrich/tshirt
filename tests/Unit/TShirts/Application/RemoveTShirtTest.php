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
use JacoBaldrich\TShirt\TShirts\Application\TShirtRemover;
use JacoBaldrich\TShirt\TShirts\Application\RemoveTShirtCommand;
use JacoBaldrich\TShirt\TShirts\Application\RemoveTShirtCommandHandler;
use JacoBaldrich\TShirt\TShirts\Domain\TShirt;

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

	public function test_removes_a_tshirt()
	{
		$command = new RemoveTShirtCommand(
			new UuidValueObject,
			'25769c6c-d34d-4bfe-ba98-e0ee856f3e7a',
			''
		);

		$this->repository->expects()
			->remove( $this->anInstanceOf( TShirt::class ) )
			->andReturn();

		$this->handler->handle( $command );
	}
}
