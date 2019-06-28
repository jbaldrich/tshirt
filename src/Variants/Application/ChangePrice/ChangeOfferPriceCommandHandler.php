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
use JacoBaldrich\TShirt\Variants\Application\PriceChanger;
use JacoBaldrich\TShirt\Variants\Application\ChangeOfferPriceCommand;

/**
 * Change Variant Offer Price Command Handler.
 */
final class ChangeOfferPriceCommandHandler
{
	private $priceChanger;

	public function __construct( PriceChanger $priceChanger )
	{
		$this->priceChanger = $priceChanger;
	}

	public function handle( ChangeOfferPriceCommand $command ): void
	{
		$id = new VariantId( $command->id() );
		$price = new VariantPrice( $command->price() );

		$this->priceChanger->changeOfferPrice( $id, $price );
	}
}
