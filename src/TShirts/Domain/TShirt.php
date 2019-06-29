<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\TShirts\Domain;

use JacoBaldrich\TShirt\Shared\TShirtId;
use JacoBaldrich\TShirt\Shared\VariantId;
use JacoBaldrich\TShirt\Shared\VariantPrice;
use JacoBaldrich\TShirt\Shared\AggregateRoot;
use JacoBaldrich\TShirt\Shared\TShirtCreated;
use JacoBaldrich\TShirt\Shared\TShirtRenamed;
use JacoBaldrich\TShirt\Shared\VariantsUpdated;
use JacoBaldrich\TShirt\Variants\Domain\Variants;
use JacoBaldrich\TShirt\TShirts\Domain\TShirtName;
use JacoBaldrich\TShirt\Shared\CheapestVariantChanged;
use JacoBaldrich\TShirt\Variants\Domain\VariantResponse;

/**
 * Entity T-Shirt.
 */
final class TShirt extends AggregateRoot
{
	/**
	 * @var TShirtId
	 */
	private $id;

	/**
	 * @var TShirtName
	 */
	private $name;

	/**
	 * @var VariantId
	 */
	private $cheapestVariantId;

	/**
	 * @var VariantPrice
	 */
	private $averagePrice;

	/**
	 * @var Discount
	 */
	private $averageDiscount;

	/**
	 * Constructor.
	 *
	 * @param TShirtId $id
	 * @param TShirtName $name
	 */
	public function __construct(
		TShirtId $id,
		TShirtName $name
	)
	{
		$this->id = $id;
		$this->name = $name;

		$this->record(
			new TShirtCreated(
				$id->value(),
				$name->value()
			)
		);
	}

	public function id(): TShirtId
	{
		return $this->id;
	}

	public function name(): TShirtName
	{
		return $this->name;
	}

	public function cheapestVariantId(): VariantId
	{
		return $this->cheapestVariantId;
	}

	public function averagePrice(): VariantPrice
	{
		return $this->averagePrice;
	}

	public function averageDiscount(): Discount
	{
		return $this->averageDiscount;
	}

	public function rename( TShirtName $name ): void
	{
		$this->name = $name;
		$this->record(
			new TShirtRenamed(
				$this->id->value(),
				$this->name->value()
			)
		);
	}

	public function updateVariants( VariantResponse ...$variants ): void
	{
		foreach ( $variants as $variant ) {
			$variantsArray[ $variant->id() ] = [
				'id' => $variant->id(),
				'size' => $variant->size(),
				'final-price' => $variant->finalPrice(),
				'discount' => $variant->discount()
			];
		}
		$prices = array_column( $variantsArray, 'final-price', 'id' );
		$discounts = array_column( $variantsArray, 'discount', 'id' );

		$this->calculateCheapestVariant( $prices );
		$this->calculateAveragePrice( $prices );
		$this->calculateAverageDiscount( $discounts );

		$this->record(
			new VariantsUpdated(
				$this->id->value(),
				[
					'product-name' => $this->name->value(),
					'cheapest-variant-id' => $this->cheapestVariantId()->value(),
					'average-price' => $this->averagePrice->value(),
					'average-discount' => $this->averageDiscount->value()
				]
			)
		);
	}

	private function calculateCheapestVariant( array $prices ): void
	{
		$minPriceId = array_keys( $prices, min( $prices ) );
		$this->cheapestVariantId = new VariantId(
			$minPriceId[0]
		);
	}

	private function calculateAveragePrice( array $prices ): void
	{
		$average = array_sum( $prices ) / count( $prices );
		$average = (int) round( $average, 0 );
		$this->averagePrice = new VariantPrice(
			$average
		);
	}

	private function calculateAverageDiscount( array $discounts ): void
	{
		$average = array_sum( $discounts ) / count( $discounts );
		$average = (int) round( $average, 0 );
		$this->averageDiscount = new Discount(
			$average
		);
	}
}
