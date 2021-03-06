<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\TShirts\Domain;

use JacoBaldrich\TShirt\Shared\TShirtId;
use JacoBaldrich\TShirt\TShirts\Domain\TShirt;

/**
 * T-shirt Repository Interface.
 */
interface TShirtRepository
{
	/**
	 * Save a T-Shirt.
	 *
	 * @param TShirt $tShirt
	 * @return void
	 */
	public function save( TShirt $tShirt ): void;

	/**
	 * Remove a T-Shirt.
	 *
	 * @param TShirt $tShirt
	 * @return void
	 */
	public function remove( TShirt $tShirt ): void;

	/**
	 * Find a T-Shirt by ID.
	 *
	 * @param TShirtId $tShirtId
	 * @return TShirt|null
	 */
	public function find( TShirtId $tShirtId ): ?TShirt;
}
