<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\Shared;

/**
 * Variant Price changed domain event.
 */
class VariantPriceChanged implements Event
{
	private $tShirtId;
	private $id;
	private $finalPrice;
	private $discount;

	public function __construct(
		string $tShirtId,
		string $id,
		string $finalPrice,
		int $discount
	)
	{
		$this->tShirtId = $tShirtId;
		$this->id = $id;
		$this->finalPrice = $finalPrice;
		$this->discount = $discount;
	}

	public function tShirtId(): string
	{
		return $this->tShirtId;
	}

	public function id(): string
	{
		return $this->id;
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
