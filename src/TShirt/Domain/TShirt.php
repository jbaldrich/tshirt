<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\TShirt\Domain;

/**
 * Entity T-Shirt.
 */
final class TShirt
{
	/**
	 * @var TShirtId
	 */
	private $id;

	/**
	 * @var TShirtName
	 */
	private $name;

	/**
	 * @var TShirtVariant
	 */
	private $variants;

	/**
	 * Constructor.
	 *
	 * @param TShirtId $id
	 * @param TShirtName $name
	 * @param TShirtVariant ...$variants
	 */
	public function __construct( TShirtId $id, TShirtName $name, TShirtVariant ...$variants )
	{
		$this->ensureNoDuplicatedSize( ...$variants );
		$this->id       = $id;
		$this->name     = $name;
		$this->variants = $variants;
	}

	public function cheapestVariant(): TShirtVariant
	{
		//array_reduce();
	}

	private function ensureNoDuplicatedSize( TShirtVariant ...$variants )
	{
		$unique = [];
		foreach ( $variants as $variant ) {
			if ( in_array( $variant->size(), $unique, true ) ) {
				throw new \InvalidArgumentException(
					sprintf(
						'No duplicated sizes please, detected <%s> more than once.',
						$variant->size()
					)
				);
			}
			$unique[] = $variant->size();
		}
	}
}
