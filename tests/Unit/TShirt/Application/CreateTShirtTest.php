<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\Tests\Unit\TShirt\Application;

use JacoBaldrich\TShirt\TShirt\Domain\TShirt;
use JacoBaldrich\TShirt\TShirt\Domain\TShirtId;
use JacoBaldrich\TShirt\TShirt\Domain\TShirtName;
use JacoBaldrich\TShirt\Tests\Unit\Shared\TestBase;
use JacoBaldrich\TShirt\TShirt\Domain\TShirtVariant;
use JacoBaldrich\TShirt\TShirt\Domain\TShirtVariantId;
use JacoBaldrich\TShirt\TShirt\Domain\TShirtVariantSize;
use JacoBaldrich\TShirt\TShirt\Domain\TShirtVariantPrice;
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
		// Variant 1
		$variant1ID    = new TShirtVariantId;
		$variant1Size  = new TShirtVariantSize('M');
		$variant1Price = new TShirtVariantPrice(1495);
		$variant1      = new TShirtVariant($variant1ID, $variant1Size, $variant1Price);
		// Variant 2
		$variant2ID         = new TShirtVariantId;
		$variant2Size       = new TShirtVariantSize('S');
		$variant2Price      = new TShirtVariantPrice(1695);
		$variant2OfferPrice = new TShirtVariantPrice(1395);
		$variant2           = new TShirtVariant($variant2ID, $variant2Size, $variant2Price, $variant2OfferPrice);
		// Product
		$productID   = new TShirtId;
		$productName = new TShirtName('Camiseta corta');
		return new TShirt($productID, $productName, $variant1, $variant2);
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
		$response = $this->whenWeSaveATShirt( $tShirt );
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
