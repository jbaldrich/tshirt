<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\TShirt\Domain;

/**
 * Entity T-shirt Variant.
 */
final class TShirtVariant
{
	/**
	 * @var TShirtVariantId
	 */
	private $id;

	/**
	 * @var TShirtVariantSize
	 */
	private $size;

	/**
	 * @var TShirtVariantPrice
	 */
	private $price;

	/**
	 * @var TShirtVariantPrice
	 */
	private $offerPrice;

	/**
	 * Constructor.
	 *
	 * @param TShirtVariantId $id
	 * @param TShirtVariantSize $size
	 * @param TShirtVariantPrice $price
	 * @param TShirtVariantPrice|null $offerPrice
	 */
	public function __construct(
		TShirtVariantId $id,
		TShirtVariantSize $size,
		TShirtVariantPrice $price,
		?TShirtVariantOfferPrice $offerPrice = null
	)
	{
		$this->id         = $id;
		$this->size       = $size;
		$this->price      = $price;
		$this->offerPrice = $offerPrice;
	}

	public function finalPrice(): TShirtVariantPrice
	{
		return $this->offerPrice ?? $this->price;
	}

	public function discount(): int
	{
	}
}
