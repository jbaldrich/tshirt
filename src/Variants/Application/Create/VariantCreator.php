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
use JacoBaldrich\TShirt\Shared\VariantPrice;
use JacoBaldrich\TShirt\Variants\Domain\Variant;
use JacoBaldrich\TShirt\Variants\Domain\VariantSize;
use JacoBaldrich\TShirt\Variants\Domain\VariantRepository;

/**
 * Variant Creator Use Case.
 */
final class VariantCreator
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
	 * Create a new Variant.
	 *
	 * @param TShirtId $tShirtId
	 * @param VariantId $id
	 * @param VariantSize $size
	 * @param VariantPrice $price
	 * @param VariantPrice|null $offerPrice
	 * @return void
	 */
	public function create(
		TShirtId $tShirtId,
		VariantId $id,
		VariantSize $size,
		VariantPrice $price,
		?VariantPrice $offerPrice = null
	): void
	{
		$variant = new Variant(
			$tShirtId,
			$id,
			$size,
			$price,
			$offerPrice
		);

		$this->repository->save( $variant );
	}
}
