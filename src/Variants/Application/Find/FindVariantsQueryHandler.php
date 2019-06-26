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
use JacoBaldrich\TShirt\Variants\Domain\VariantId;
use JacoBaldrich\TShirt\Variants\Domain\VariantSize;
use JacoBaldrich\TShirt\Variants\Domain\VariantPrice;
use JacoBaldrich\TShirt\Variants\Application\VariantFinder;
use JacoBaldrich\TShirt\Variants\Application\CreateVariantCommand;

/**
 * Variants Find Query Handler.
 */
final class FindVariantsQueryHandler
{
	private $finder;

	public function __construct( VariantsFinder $finder )
	{
		$this->finder = $finder;
	}

	public function handle( FindVariantsQuery $query )
	{
		$tShirtId = new TShirtId( $query->tShirtId() );

		return $this->finder->find( $tShirtId );
	}
}
