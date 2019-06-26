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
use JacoBaldrich\TShirt\Variants\Domain\VariantId;
use JacoBaldrich\TShirt\Variants\Domain\VariantSize;
use JacoBaldrich\TShirt\Variants\Domain\VariantPrice;
use JacoBaldrich\TShirt\Variants\Application\VariantCreator;
use JacoBaldrich\TShirt\Variants\Application\CreateVariantCommand;

/**
 * Variant Creator Command Handler.
 */
final class CreateVariantCommandHandler
{
	private $variantCreator;

	public function __construct( VariantCreator $variantCreator )
	{
		$this->variantCreator = $variantCreator;
	}

	public function handle( CreateVariantCommand $command ): void
	{
		$tShirtId   = new TShirtId( $command->tShirtId() );
		$id         = new VariantId( $command->id() );
		$size       = new VariantSize( $command->size() );
		$price      = new VariantPrice( $command->price() );
		$offerPrice = is_null( $command->offerPrice() )
			? null
			: new VariantPrice( $command->offerPrice() );

		$this->variantCreator->create(
			$tShirtId,
			$id,
			$size,
			$price,
			$offerPrice
		);
	}
}
