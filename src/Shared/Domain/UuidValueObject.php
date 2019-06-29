<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\Shared;

use Ramsey\Uuid\Uuid;

class UuidValueObject
{

	/**
	 * @var string
	 */
	protected $value;

	/**
	 * Constructor.
	 *
	 * @param string|null $value
	 */
	public function __construct( ?string $value = null )
	{
		$value = $value ?? ( Uuid::uuid4() )->toString();
		$this->validate( $value );
		$this->value = $value;
	}

	/**
	 * Get the value
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
	protected function validate( string $value ) {
		if ( ! Uuid::isValid( $value ) ) {
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
