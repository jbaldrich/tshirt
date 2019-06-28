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
use JacoBaldrich\TShirt\TShirts\Domain\TShirtName;
use JacoBaldrich\TShirt\Variants\Domain\VariantPrice;
use JacoBaldrich\TShirt\Shared\TShirtCreated;
use JacoBaldrich\TShirt\Shared\AggregateRoot;

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
		TShirtName $name,
		VariantId $cheapestVariantId = null,
		VariantPrice $averagePrice = null,
		Discount $averageDiscount = null
	)
	{
		$this->id = $id;
		$this->name = $name;
		$this->cheapestVariantId = $cheapestVariantId;
		$this->averagePrice = $averagePrice;
		$this->averageDiscount = $averageDiscount;

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
	}
}
