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
use JacoBaldrich\TShirt\Variants\Domain\VariantId;
use JacoBaldrich\TShirt\Variants\Domain\VariantSize;
use JacoBaldrich\TShirt\Variants\Domain\VariantPrice;

/**
 * Entity Variant.
 */
final class Variant
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
	}

	public function finalPrice(): VariantPrice
	{
		return $this->offerPrice ?? $this->price;
	}

	public function discount(): int
	{
	}

	public function size(): string
	{
		return $this->size->value();
	}
}
