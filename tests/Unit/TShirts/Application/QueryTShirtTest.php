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
use JacoBaldrich\TShirt\Tests\Unit\Shared\TestBase;
use JacoBaldrich\TShirt\TShirts\Domain\TShirtRepository;
use JacoBaldrich\TShirt\TShirts\Application\TShirtFinder;
use JacoBaldrich\TShirt\TShirts\Application\FindTShirtQuery;
use JacoBaldrich\TShirt\TShirts\Application\FindTShirtQueryHandler;

/**
 * Tests query a t-shirt by id use case.
 */
final class QueryTShirtTest extends TestBase
{
	private $repository;
	private $finder;
	private $handler;

	protected function setUp(): void
	{
		parent::setUp();
		$this->repository = $this->mock( TShirtRepository::class );
		$this->finder = new TShirtFinder( $this->repository );
		$this->handler = new FindTShirtQueryHandler( $this->finder );
	}

	public function test_query_a_TShirt()
	{
		$query = new FindTShirtQuery(
			'25769c6c-d34d-4bfe-ba98-e0ee856f3e7a'
		);

		$this->repository->expects()
			->find( $this->anInstanceOf( TShirtId::class ) )
			->andReturnNull();

		$this->handler->handle( $query );
	}
}
