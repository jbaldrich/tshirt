<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\Variants\Application;

use JacoBaldrich\TShirt\Shared\Query;

/**
 * Variants Find Query.
 */
final class FindVariantsQuery implements Query
{
	private $tShirtId;

	/**
	 * Constructor.
	 *
	 * @param string $tShirtId
	 */
	public function __construct( string $tShirtId )
	{
		$this->tShirtId = $tShirtId;
	}

	public function tShirtId(): string
	{
		return $this->tShirtId;
	}
}
