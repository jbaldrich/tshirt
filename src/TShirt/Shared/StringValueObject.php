<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\TShirt\Shared;

abstract class StringValueObject
{
	/**
	 * @var string
	 */
	protected $value;

	/**
	 * Constructor.
	 *
	 * @param string $value
	 */
	public function __construct( string $value )
	{
		$this->validate( $value );
		$this->value = $value;
	}

	/**
	 * Get the value.
	 *
	 * @return string
	 */
	public function value(): string
	{
		return $this->value;
	}

	/**
	 * Guard clause to check if the value follows the
	 * required parameters.
	 *
	 * @param string $value
	 * @throws \InvalidArgumentException
	 * @return void
	 */
	abstract protected function validate( string $value );
}
