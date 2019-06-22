<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\TShirt\Shared;

abstract class IntValueObject
{
	/**
	 * @var int
	 */
	protected $value;

	/**
	 * Constructor.
	 *
	 * @param int $value
	 */
	public function __construct( int $value )
	{
		$this->validate( $value );
		$this->value = $value;
	}

	/**
	 * Get the value.
	 *
	 * @return int
	 */
	public function value(): int
	{
		return $this->value;
	}

	/**
	 * Guard clause to check if the value follows the
	 * required parameters.
	 *
	 * @param int $value
	 * @throws \InvalidArgumentException
	 * @return void
	 */
	abstract protected function validate( int $value );
}
