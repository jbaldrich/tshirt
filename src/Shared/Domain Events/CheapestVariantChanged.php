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
 * T-shirt cheapest variant changed domain event.
 */
class CheapestVariantChanged implements Event
{
	private $id;
	private $cheapestVariantId;

	public function __construct( string $id, string $cheapestVariantId )
	{
		$this->id = $id;
		$this->cheapestVariantId = $cheapestVariantId;
	}

	public function id(): string
	{
		return $this->id;
	}

	public function cheapestVariantId(): string
	{
		return $this->cheapestVariantId;
	}
}
