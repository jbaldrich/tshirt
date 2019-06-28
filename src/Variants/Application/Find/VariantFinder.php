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
use JacoBaldrich\TShirt\Shared\VariantId;
use JacoBaldrich\TShirt\Variants\Domain\Variant;
use JacoBaldrich\TShirt\Variants\Domain\Variants;
use JacoBaldrich\TShirt\Variants\Domain\VariantRepository;

/**
 * Variant Finder Use Case.
 */
final class VariantFinder
{
	/**
	 * @var VariantRepository
	 */
	private $repository;

	/**
	 * Constructor.
	 *
	 * @param VariantRepository $repository
	 */
	public function __construct( VariantRepository $repository )
	{
		$this->repository = $repository;
	}

	/**
	 * Find all T-shirt Variants by T-shirt ID.
	 *
	 * @param TShirtId $tShirtId
	 */
	public function findAll( TShirtId $tShirtId ): ?Variants
	{
		return $this->repository->findByTShirtId( $tShirtId );
	}

	/**
	 * Find a T-shirt Variants by ID.
	 *
	 * @param VariantId $tShirtId
	 */
	public function find( VariantId $id ): ?Variant
	{
		return $this->repository->find( $id );
	}
}
