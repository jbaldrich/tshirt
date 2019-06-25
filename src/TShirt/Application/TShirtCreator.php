<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\TShirt\Application;

use JacoBaldrich\TShirt\TShirt\Domain\TShirt;
use JacoBaldrich\TShirt\TShirt\Domain\TShirtId;
use JacoBaldrich\TShirt\TShirt\Domain\TShirtName;
use JacoBaldrich\TShirt\TShirt\Shared\UuidValueObject;
use JacoBaldrich\TShirt\TShirt\Domain\TShirtRepository;
use JacoBaldrich\TShirt\TShirt\Application\TShirtVariantCreator;

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
	 * @param UuidValueObject $id
	 * @param string $name
	 * @param array ...$variants
	 * @return void
	 */
	public function create( UuidValueObject $id, string $name, array ...$variants )
	{
		$variantCollection = array_map(
			function( $variant ) {
				return TShirtVariantCreator::create(
					$variant['id'],
					$variant['size'],
					$variant['price'],
					isset( $variant['offer_price'] ) ? $variant['offer_price'] : null
				);
			},
			$variants
		);
		// Product
		$tShirtId = new TShirtId( $id->value() );
		$tShirtName = new TShirtName( $name );
		return new TShirt(
			$tShirtId,
			$tShirtName,
			...$variantCollection
		);
	}
}
