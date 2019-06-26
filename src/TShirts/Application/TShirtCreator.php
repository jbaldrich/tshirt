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
 * T-Shirt Creator Use Case.
 */
final class TShirtCreator
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
	 * Create a new T-shirt
	 *
	 * @param TShirtId $id
	 * @param TShirtName $name
	 * @return void
	 */
	public function create( TShirtId $id, TShirtName $name )
	{
		$tShirt = new TShirt( $id, $name );

		$this->repository->save( $tShirt );
	}
}
