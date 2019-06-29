<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\Variants\Domain;

use JacoBaldrich\TShirt\Shared\TShirtId;
use JacoBaldrich\TShirt\Shared\VariantId;
use JacoBaldrich\TShirt\Shared\VariantPrice;
use JacoBaldrich\TShirt\Shared\AggregateRoot;
use JacoBaldrich\TShirt\Shared\VariantCreated;
use JacoBaldrich\TShirt\Shared\VariantPriceChanged;
use JacoBaldrich\TShirt\Variants\Domain\VariantSize;

/**
 * Entity Variant.
 */
final class Variant extends AggregateRoot
{
	/**
	 * @var TShirtId
	 */
	private $tShirtId;
	
	/**
	 * @var VariantId
	 */
	private $id;

	/**
	 * @var VariantSize
	 */
	private $size;

	/**
	 * @var VariantPrice
	 */
	private $price;

	/**
	 * @var VariantPrice
	 */
	private $offerPrice;

	/**
	 * Constructor.
	 *
	 * @param TShirtId $tShirtId
	 * @param VariantId $id
	 * @param VariantSize $size
	 * @param VariantPrice $price
	 * @param VariantPrice|null $offerPrice
	 */
	public function __construct(
		TShirtId $tShirtId,
		VariantId $id,
		VariantSize $size,
		VariantPrice $price,
		?VariantPrice $offerPrice = null
	)
	{
		$this->tShirtId   = $tShirtId;
		$this->id         = $id;
		$this->size       = $size;
		$this->price      = $price;
		$this->offerPrice = $offerPrice;

		$this->record(
			new VariantCreated(
				$this->id->value(),
				[
					'tshirt-id' => $this->tShirtId->value(),
					'final-price' => $this->finalPrice()->value(),
					'discount' => $this->discount()
				]
			)
		);
	}

	public function finalPrice(): VariantPrice
	{
		return $this->offerPrice ?? $this->price;
	}

	public function discount(): int
	{
		return is_null( $this->offerPrice )
			? 0
			: 10000 - (int) round(
				$this->finalPrice()->value() / $this->price->value() * 10000,
				2
			);
	}

	public function size(): VariantSize
	{
		return $this->size;
	}

	public function id(): VariantId
	{
		return $this->id;
	}

	public function tShirtId(): TShirtId
	{
		return $this->tShirtId;
	}

	public function changePrice( VariantPrice $price ): void
	{
		$this->price = $price;

		$this->record(
			new VariantPriceChanged(
				$this->tShirtId->value(),
				$this->id->value(),
				$this->finalPrice()->value(),
				$this->discount()
			)
		);
	}

	public function changeOfferPrice( VariantPrice $price ): void
	{
		$this->offerPrice = $price;
	}
}
