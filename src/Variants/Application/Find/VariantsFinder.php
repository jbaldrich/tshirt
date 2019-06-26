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
use JacoBaldrich\TShirt\Variants\Domain\Variant;
use JacoBaldrich\TShirt\Variants\Domain\VariantId;
use JacoBaldrich\TShirt\Variants\Domain\VariantSize;
use JacoBaldrich\TShirt\Variants\Domain\VariantPrice;
use JacoBaldrich\TShirt\Variants\Domain\VariantRepository;

/**
 * Variant Finder Use Case.
 */
final class VariantsFinder
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
	 * @return void
	 */
	public function find( TShirtId $tShirtId )
	{
		return $this->repository->save( $variant );
	}
}
