<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\TShirts\Infrastructure;

use ArrayObject;
use JacoBaldrich\TShirt\Shared\TShirtId;
use JacoBaldrich\TShirt\TShirts\Domain\TShirt;
use JacoBaldrich\TShirt\TShirts\Domain\TShirtRepository;

/**
 * In memory T-Shirt Repository.
 */
final class InMemoryTShirtRepository extends ArrayObject implements TShirtRepository
{
	/**
	 * Save a T-Shirt.
	 *
	 * @param TShirt $tShirt
	 * @return void
	 */
	public function save( TShirt $tShirt ): void
	{
		$this->offsetSet( $tShirt->id()->value(), $tShirt );
	}

	/**
	 * Remove a T-Shirt.
	 *
	 * @param TShirt $tShirt
	 * @return void
	 */
	public function remove( TShirt $tShirt ): void
	{
		$this->offsetUnset( $tShirt->id()->value() );
	}

	/**
	 * Find a T-Shirt.
	 *
	 * @param TShirtId $tShirtId
	 * @return TShirt|null
	 */
	public function find( TShirtId $tShirtId ): ?TShirt
	{
		return $this->offsetGet( $tShirtId->value() );
	}
}
