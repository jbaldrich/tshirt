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
use JacoBaldrich\TShirt\Shared\VariantPrice;
use JacoBaldrich\TShirt\Variants\Domain\VariantRepository;
use JacoBaldrich\TShirt\Variants\Application\VariantFinder;

/**
 * Price Changer Use Case.
 */
final class PriceChanger
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
	 * Change Variant Price.
	 *
	 * @param VariantId $id
	 * @param VariantPrice $price
	 * @return void
	 */
	public function changePrice( VariantId $id, VariantPrice $price ): void
	{
		$variant = $this->finder->find( $id );
		$this->ensureVariantIsNotNull( $variant );
		$variant->changePrice( $price );
		$this->repository->save( $variant );
	}

	/**
	 * Change Variant Offer Price.
	 *
	 * @param VariantId $id
	 * @param VariantPrice $price
	 * @return void
	 */
	public function changeOfferPrice( VariantId $id, VariantPrice $price ): void
	{
		$variant = $this->finder->find( $id );
		$this->ensureVariantIsNotNull( $variant );
		$variant->changeOfferPrice( $price );
		$this->repository->save( $variant );
	}

	private function ensureVariantIsNotNull( $variant ): void
	{
		if ( is_null( $variant ) ) {
			throw new \Exception(
				'The T-Shirt Id does not exist'
			);
		}
	}
}
