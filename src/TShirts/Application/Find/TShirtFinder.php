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
use JacoBaldrich\TShirt\TShirts\Domain\TShirt;
use JacoBaldrich\TShirt\TShirts\Domain\TShirtRepository;

/**
 * T-Shirt Finder Use Case.
 */
final class TShirtFinder
{
	/**
	 * @var TShirtRepository
	 */
	private $repository;

	/**
	 * Constructor.
	 *
	 * @param TShirtRepository $repository
	 */
	public function __construct( TShirtRepository $repository )
	{
		$this->repository = $repository;
	}

	/**
	 * Find a TShirt by its ID.
	 *
	 * @param TShirtId $tShirtId
	 */
	public function find( TShirtId $tShirtId ): ?TShirt
	{
		return $this->repository->find( $tShirtId );
	}
}
