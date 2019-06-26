<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\Shared;

use Money\Money;

abstract class PriceValueObject
{
	/**
	 * @var Money
	 */
	protected $price;

	/**
	 * Constructor.
	 *
	 * @param int $price
	 */
	public function __construct( int $price )
	{
		$this->validate( $price );
		$this->price = Money::EUR( $price );
	}

	/**
	 * Get the value.
	 *
	 * @return int
	 */
	public function value(): int
	{
		return $this->price->getAmount();
	}

	/**
	 * Return an integer less than, equal to, or greater than zero
	 * if the value of this object is considered to be respectively
	 * less than, equal to, or greater than the other.
	 *
	 * @param PriceValueObject $other
	 *
	 * @return int
	 */
	public function compare( PriceValueObject $other ): int
	{
		return $this->price->compare( $other->moneyObject() );
	}

	/**
	 * Return the Money object.
	 *
	 * @return Money
	 */
	public function moneyObject(): Money
	{
		return $this->price;
	}

	/**
	 * Guard clause to check if the value follows the
	 * required parameters.
	 *
	 * @param int $price
	 * @throws \InvalidArgumentException
	 * @return void
	 */
	protected function validate( int $price )
	{
		if ( $price < 0 ) {
			throw new \InvalidArgumentException(
				sprintf(
					'<%s> should be an integer bigger than 0, <%s> provided instead.',
					static::class,
					is_scalar( $price ) ? $price : gettype( $price )
				)
			);
		}
	}
}
