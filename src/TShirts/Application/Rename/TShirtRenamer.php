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
use JacoBaldrich\TShirt\TShirts\Domain\TShirtName;
use JacoBaldrich\TShirt\TShirts\Domain\TShirtRepository;
use JacoBaldrich\TShirt\TShirts\Application\TShirtFinder;

/**
 * T-Shirt Renamer Use Case.
 */
final class TShirtRenamer
{
	/**
	 * @var TShirtRepository
	 */
	private $repository;

	/**
	 * @var TShirtFinder
	 */
	private $finder;

	/**
	 * Constructor.
	 *
	 * @param TShirtRepository $repository
	 */
	public function __construct( TShirtRepository $repository )
	{
		$this->repository = $repository;
		$this->finder = new TShirtFinder( $this->repository );
	}

	/**
	 * Create a new T-shirt
	 *
	 * @param TShirtId $id
	 * @param TShirtName $name
	 * @return void
	 */
	public function rename( TShirtId $id, TShirtName $name )
	{
		$tShirt = $this->finder->find( $id );
		$this->ensureTShirtIsNotNull( $tShirt );
		$tShirt->rename( $name );
		$this->repository->save( $tShirt );
	}

	private function ensureTShirtIsNotNull( $tShirt )
	{
		if ( is_null( $tShirt ) ) {
			throw new \Exception(
				'The T-Shirt Id does not exist'
			);
		}
	}
}
