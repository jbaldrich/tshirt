<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\Variations\Domain;

use JacoBaldrich\TShirt\Variations\Domain\Variant;
use JacoBaldrich\TShirt\Variations\Domain\VariantId;

/**
 * Variant Repository Interface.
 */
interface VariantRepository
{
	/**
	 * Save a Variant.
	 *
	 * @param Variant $variant
	 * @return void
	 */
	public function save( Variant $variant ): void;

	/**
	 * Remove a Variant.
	 *
	 * @param Variant $variant
	 * @return void
	 */
	public function remove( Variant $variant ): void;

	/**
	 * Find a Variant by ID.
	 *
	 * @param VariantId $variantId
	 * @return Variant|null
	 */
	public function find( VariantId $variantId ): ?Variant;
}
