<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\Variants\Application;

use JacoBaldrich\TShirt\Shared\VariantId;
use JacoBaldrich\TShirt\Variants\Domain\VariantRepository;
use JacoBaldrich\TShirt\Variants\Application\VariantFinder;

/**
 * Variant Remover Use Case.
 */
final class VariantRemover
{
	/**
	 * @var VariantRepository
	 */
	private $repository;

	/**
	 * @var VariantFinder
	 */
	private $finder;

	/**
	 * Constructor.
	 *
	 * @param VariantRepository $repository
	 */
	public function __construct( VariantRepository $repository )
	{
		$this->repository = $repository;
		$this->finder = new VariantFinder( $this->repository );
	}

	/**
	 * Remove a variant.
	 *
	 * @param VariantId $id
	 * @return void
	 */
	public function remove( VariantId $id )
	{
		$variant = $this->finder->find( $id );
		$this->ensureVariantIsNotNull( $variant );
		$this->repository->remove( $variant );
	}

	private function ensureVariantIsNotNull( $variant )
	{
		if ( is_null( $variant ) ) {
			throw new \Exception(
				'The T-Shirt Id does not exist'
			);
		}
	}
}
