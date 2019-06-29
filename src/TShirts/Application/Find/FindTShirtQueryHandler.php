<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\TShirts\Application;

use JacoBaldrich\TShirt\Shared\TShirtId;
use JacoBaldrich\TShirt\TShirts\Application\TShirtFinder;
use JacoBaldrich\TShirt\TShirts\Application\FindTShirtQuery;
use JacoBaldrich\TShirt\TShirts\Domain\TShirtResponseConverter;
use JacoBaldrich\TShirt\TShirts\Domain\TShirtResponse;

/**
 * TShirt Find Query Handler.
 */
final class FindTShirtQueryHandler
{
	private $finder;

	public function __construct( TShirtFinder $finder )
	{
		$this->finder = $finder;
	}

	public function handle( FindTShirtQuery $query ): ?TShirtResponse
	{
		$tShirtId = new TShirtId( $query->tShirtId() );

		$tShirt = $this->finder->find( $tShirtId );

		return TShirtResponseConverter::convert( $tShirt );
	}
}
