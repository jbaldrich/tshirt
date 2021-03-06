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
 * Variants Collection.
 */
final class Variants
{
	private $variants = [];

	public function __construct( Variant ...$variant )
	{
		$this->variants = $variant;
	}

	public function getCollection()
	{
		return $this->variants;
	}
}
