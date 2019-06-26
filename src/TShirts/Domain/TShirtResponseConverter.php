<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\TShirts\Domain;

use JacoBaldrich\TShirt\TShirt\Domain\TShirt;
use JacoBaldrich\TShirt\TShirts\Domain\TShirtResponse;

/**
 * T-Shirt Response Converter.
 */
final class TShirtResponseConverter
{
	public static function convert( TShirt $tShirt ): TShirtResponse
	{
		return new TShirtResponse(
			$tShirt->id()->value(),
			$tShirt->name()->value()
		);
	}
}
