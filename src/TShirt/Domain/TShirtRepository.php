<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\TShirt\Domain;

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
	 * Find a T-Shirt.
	 *
	 * @param TShirt $tShirt
	 * @return TShirt|null
	 */
	public function find( TShirt $tShirt ): ?TShirt;
}
