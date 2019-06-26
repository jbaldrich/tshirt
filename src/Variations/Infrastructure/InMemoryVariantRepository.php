<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\Variations\Domain;

use ArrayObject;
use JacoBaldrich\TShirt\Variations\Domain\Variant;
use JacoBaldrich\TShirt\Variations\Domain\VariantId;
use JacoBaldrich\TShirt\Variations\Domain\VariantRepository;

/**
 * In memory Variant Repository.
 */
final class InMemoryVariantRepository extends ArrayObject implements VariantRepository
{
	/**
	 * Save a Variant.
	 *
	 * @param Variant $variant
	 * @return void
	 */
	public function save( Variant $variant ): void
	{
		$this->offsetSet( $variant->id()->value(), $variant );
	}

	/**
	 * Remove a Variant.
	 *
	 * @param Variant $variant
	 * @return void
	 */
	public function remove( Variant $variant ): void
	{
		$this->offsetUnset( $variant->id()->value() );
	}

	/**
	 * Find a Variant.
	 *
	 * @param VariantId $variantId
	 * @return Variant|null
	 */
	public function find( VariantId $variantId ): ?Variant
	{
		return $this->offsetGet( $variantId->value() );
	}
}
