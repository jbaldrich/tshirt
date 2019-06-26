<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\Tests\Unit\TShirts\Application;

use Mockery;
use JacoBaldrich\TShirt\Shared\TShirtId;
use JacoBaldrich\TShirt\Tests\Unit\Shared\TestBase;
use JacoBaldrich\TShirt\Shared\UuidValueObject;
use JacoBaldrich\TShirt\TShirts\Domain\TShirtRepository;
use JacoBaldrich\TShirt\TShirts\Application\TShirtCreator;
use JacoBaldrich\TShirt\TShirts\Application\CreateTShirtCommand;
use JacoBaldrich\TShirt\TShirts\Application\CreateTShirtCommandHandler;
use JacoBaldrich\TShirt\TShirts\Domain\TShirt;
use JacoBaldrich\TShirt\TShirts\Domain\TShirtName;
use JacoBaldrich\TShirt\TShirts\Infrastructure\InMemoryTShirtRepository;

/**
 * Tests for create a T-shirt use case.
 */
final class CreateTShirtTest extends TestBase
{
	private $repository;
	private $creator;

	protected function setUp(): void
	{
		parent::setUp();
		//$this->repository = $this->mock( TShirtRepository::class );
		$this->repository = new InMemoryTShirtRepository();
		$this->creator = new TShirtCreator( $this->repository );
	}

	public function test_creates_a_tshirt()
	{
		$tShirt = new TShirt(
			new TShirtId('25769c6c-d34d-4bfe-ba98-e0ee856f3e7a'),
			new TShirtName('Camiseta de manga corta')
		);
		$command = new CreateTShirtCommand(
			new UuidValueObject,
			'25769c6c-d34d-4bfe-ba98-e0ee856f3e7a',
			'Camiseta de manga corta'
		);
		$handler = new CreateTShirtCommandHandler( $this->creator );
		$handler->handle( $command );

		$fromRepository = $this->repository->find(
			new TShirtId('25769c6c-d34d-4bfe-ba98-e0ee856f3e7a')
		);

		$this->assertEquals($tShirt, $fromRepository);
	}
}
