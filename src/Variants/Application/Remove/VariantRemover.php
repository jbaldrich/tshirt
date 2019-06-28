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
use JacoBaldrich\TShirt\TShirts\Domain\TShirtName;
use JacoBaldrich\TShirt\TShirts\Domain\TShirtRepository;

/**
 * T-Shirt Remover Use Case.
 */
final class VariantRemover
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
	 * Remove a new T-shirt
	 *
	 * @param TShirtId $id
	 * @param TShirtName $name
	 * @return void
	 */
	public function remove( TShirtId $id )
	{
		$tShirt = $this->finder->find( $id );
		$this->ensureTShirtIsNotNull( $tShirt );
		$this->repository->remove( $tShirt );
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
