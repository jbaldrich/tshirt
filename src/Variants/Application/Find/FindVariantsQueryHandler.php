<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\Variants\Application;

use JacoBaldrich\TShirt\Shared\TShirtId;
use JacoBaldrich\TShirt\Variants\Application\VariantFinder;
use JacoBaldrich\TShirt\Variants\Application\FindVariantsQuery;
use JacoBaldrich\TShirt\Variants\Domain\VariantsResponseConverter;

/**
 * Variants Find Query Handler.
 */
final class FindVariantsQueryHandler
{
	private $finder;

	public function __construct( VariantFinder $finder )
	{
		$this->finder = $finder;
	}

	public function handle( FindVariantsQuery $query ): ?array
	{
		$tShirtId = new TShirtId( $query->tShirtId() );

		$variants = $this->finder->findAll( $tShirtId );

		return VariantsResponseConverter::convert( $variants );
	}
}
