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
use JacoBaldrich\TShirt\Variants\Domain\VariantRepository;
use JacoBaldrich\TShirt\Variants\Application\VariantFinder;
use JacoBaldrich\TShirt\Variants\Application\FindVariantsQuery;
use JacoBaldrich\TShirt\Variants\Application\FindVariantsQueryHandler;

/**
 * Tests query all variants by t-shirt id use case.
 */
final class FindVariantsTest extends TestBase
{
	private $repository;
	private $finder;
	private $handler;

	protected function setUp(): void
	{
		parent::setUp();
		$this->repository = $this->mock( VariantRepository::class );
		$this->finder = new VariantFinder( $this->repository );
		$this->handler = new FindVariantsQueryHandler( $this->finder );
	}

	public function test_query_a_variant()
	{
		$query = new FindVariantsQuery(
			'25769c6c-d34d-4bfe-ba98-e0ee856f3e7a'
		);

		$this->repository->expects()
			->findByTShirtId( $this->anInstanceOf( TShirtId::class ) )
			->andReturnNull();

		$this->handler->handle( $query );
	}
}
