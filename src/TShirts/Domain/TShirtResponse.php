<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\TShirts\Domain;

use JacoBaldrich\TShirt\Shared\Response;

/**
 * T-Shirt Response.
 */
final class TShirtResponse implements Response
{
	private $id;
	private $name;
	private $cheapestVariantId;
	private $averagePrice;
	private $averageDiscount;

	/**
	 * Constructor.
	 *
	 * @param string $id
	 * @param string $name
	 * @param string $cheapestVariantId
	 * @param string $averagePrice
	 * @param integer $averageDiscount
	 */
	public function __construct(
		string $id,
		string $name,
		string $cheapestVariantId,
		string $averagePrice,
		int $averageDiscount
	)
	{
		$this->id = $id;
		$this->name = $name;
		$this->cheapestVariantId = $cheapestVariantId;
		$this->averagePrice = $averagePrice;
		$this->averageDiscount = $averageDiscount;
	}

	public function id(): string
	{
		return $this->id;
	}

	public function name(): string
	{
		return $this->name;
	}

	public function cheapestVariantId(): string
	{
		return $this->cheapestVariantId;
	}

	public function averagePrice(): string
	{
		return $this->averagePrice;
	}

	public function averageDiscount(): int
	{
		return $this->averageDiscount;
	}
}
