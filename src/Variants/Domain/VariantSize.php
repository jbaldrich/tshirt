<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\Variants\Domain;

use JacoBaldrich\TShirt\Shared\StringValueObject;

/**
 * Variant Id Value Object.
 */
final class VariantSize extends StringValueObject
{
	/**
	 * @var array
	 */
	private $validValues = [
		'S',
		'M',
		'L',
	];

	/**
	 * Guard clause to check if the value follows the
	 * required parameters.
	 *
	 * @param string $value
	 * @throws \InvalidArgumentException
	 * @return void
	 */
	protected function validate( string $value )
	{
		if ( ! in_array( $value, $this->validValues, true ) ) {
			throw new \InvalidArgumentException(
				sprintf(
					'<%s> does not allow the value <%s>.',
					static::class,
					is_scalar( $value ) ? $value : gettype( $value )
				)
			);
		}
	}
}
