<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\Variants\Domain;

use JacoBaldrich\TShirt\Shared\Response;

/**
 * Variant Response.
 */
final class VariantResponse implements Response
{
	private $tShirtId;
	private $id;
	private $size;
	private $finalPrice;
	private $discount;

	/**
	 * Constructor.
	 *
	 * @param string $tShirtId
	 * @param string $id
	 * @param string $size
	 * @param string $finalPrice
	 * @param integer $discount
	 */
	public function __construct(
		string $tShirtId,
		string $id,
		string $size,
		string $finalPrice,
		int $discount
	)
	{
		$this->tShirtId   = $tShirtId;
		$this->id         = $id;
		$this->size       = $size;
		$this->finalPrice = $finalPrice;
		$this->discount   = $discount;
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

	public function finalPrice(): string
	{
		return $this->finalPrice;
	}

	public function discount(): int
	{
		return $this->discount;
	}
}
