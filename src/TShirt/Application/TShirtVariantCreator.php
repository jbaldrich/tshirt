<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\TShirt\Application;

use JacoBaldrich\TShirt\TShirt\Domain\TShirtVariant;
use JacoBaldrich\TShirt\TShirt\Domain\TShirtVariantId;
use JacoBaldrich\TShirt\TShirt\Shared\UuidValueObject;
use JacoBaldrich\TShirt\TShirt\Domain\TShirtVariantSize;
use JacoBaldrich\TShirt\TShirt\Domain\TShirtVariantPrice;

/**
 * T-Shirt Creator Use Case.
 */
final class TShirtVariantCreator
{
	/**
	 * Create a new Variant T-shirt.
	 *
	 * @param UuidValueObject $id
	 * @param string $size
	 * @param integer $price
	 * @param integer $offerPrice
	 * @return TShirtVariant
	 */
	public static function create(
		UuidValueObject $id,
		string $size,
		int $price,
		int $offerPrice = null
	): TShirtVariant
	{
		return new TShirtVariant(
			new TShirtVariantId( $id->value() ),
			new TShirtVariantSize( $size ),
			new TShirtVariantPrice( $price ),
			is_null( $offerPrice ) ? $offerPrice : new TShirtVariantPrice( $offerPrice )
		);
	}
}
