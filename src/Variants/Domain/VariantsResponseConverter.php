<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\TShirts\Domain;

/**
 * Variants Response Converter.
 */
final class VariantsResponseConverter
{
	public static function convert( Variants $variants ): VariantsResponse
	{
		return array_map( function( $variant ) {
			return new VariantResponse(
				$variant->id()->value()
			);
			},
			$variants
		);
	}
}
