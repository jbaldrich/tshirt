<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\Tests\Unit\TShirt\Application;

use JacoBaldrich\TShirt\TShirt\Domain\TShirtId;
use JacoBaldrich\TShirt\Tests\Unit\Shared\TestBase;
use JacoBaldrich\TShirt\TShirt\Shared\UuidValueObject;
use JacoBaldrich\TShirt\TShirt\Application\TShirtCreator;
use JacoBaldrich\TShirt\TShirt\Infrastructure\InMemoryTShirtRepository;

/**
 * Tests for create a T-shirt use case.
 */
final class CreateTShirtTest extends TestBase
{
	private $repository;

	protected function setUp(): void
	{
		parent::setUp();
		$this->repository = new InMemoryTShirtRepository;
	}

	private function givenWeHaveATShirt()
	{
		$creator = new TShirtCreator( $this->repository );
		return $creator->create(
			new UuidValueObject,
			'Camiseta mojada',
			[
				'id' => new UuidValueObject,
				'size' => 'M',
				'price' => 1325,
				'offer_price' => 1099
			],
			[
				'id' => new UuidValueObject,
				'size' => 'S',
				'price' => 1225
			],
			[
				'id' => new UuidValueObject,
				'size' => 'L',
				'price' => 2099,
				'offer_price' => 1899
			]
		);
	}

	private function whenWeSaveATShirt( $tShirt )
	{
		return $this->repository->save( $tShirt );
	}

	public function test_creates_a_tshirt()
	{
		// Given
		$tShirt   = $this->givenWeHaveATShirt();
		// When
		$this->whenWeSaveATShirt( $tShirt );
		// Then
		$this->assertSame( $tShirt, $this->repository->find( new TShirtId( $tShirt->id() ) ) );
	}

	public function test_returns_null()
	{
		// Given
		$tShirt   = $this->givenWeHaveATShirt();
		// When
		$response = $this->whenWeSaveATShirt( $tShirt );
		// Then
		$this->assertNull( $response );
	}
}
