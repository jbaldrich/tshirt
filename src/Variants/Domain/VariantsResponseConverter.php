<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\Variants\Domain;

/**
 * Variants Response Converter.
 */
final class VariantsResponseConverter
{
	public static function convert( ?Variants $variants ): ?array
	{
		if ( is_null( $variants ) ) {
			return null;
		}

		return array_map(
			function( $variant ) {
				return new VariantResponse(
					$variant->tShirtId()->value(),
					$variant->id()->value(),
					$variant->size()->value(),
					$variant->finalPrice()->value(),
					$variant->discount()
				);
			},
			$variants->getCollection()
		);
	}
}
