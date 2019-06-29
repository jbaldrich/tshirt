<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\TShirts\Domain;

use JacoBaldrich\TShirt\Shared\IntValueObject;

/**
 * Discount Value Object.
 */
final class Discount extends IntValueObject
{
	/**
	 * Guard clause to check if the value follows the
	 * required parameters.
	 *
	 * @param string $value
	 * @throws \InvalidArgumentException
	 * @return void
	 */
	protected function validate( int $value )
	{
	}
}
