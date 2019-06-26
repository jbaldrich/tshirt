<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\Variants\Domain;

/**
 * Variant Response.
 */
final class VariantResponse implements Response
{
	private $tShirtId;
	private $id;
	private $size;
	private $price;
	private $offerPrice;

	/**
	 * Constructor.
	 *
	 * @param string $tShirtId
	 * @param string $id
	 * @param string $size
	 * @param integer $price
	 * @param integer $offerPrice
	 */
	public function __construct(
		string $tShirtId,
		string $id,
		string $size,
		int $price,
		int $offerPrice
	)
	{
		$this->tShirtId   = $tShirtId;
		$this->id         = $id;
		$this->size       = $size;
		$this->price      = $price;
		$this->offerPrice = $offerPrice;
	}

	public function tShirtId(): string
	{
		return $this->tShirtId;
	}

	public function id(): string
	{
		return $this->id;
	}

	public function size(): string
	{
		return $this->size;
	}

	public function price(): int
	{
		return $this->price;
	}

	public function offerPrice(): int
	{
		return $this->offerPrice;
	}
}
