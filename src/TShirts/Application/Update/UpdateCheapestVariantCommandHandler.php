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
use JacoBaldrich\TShirt\TShirts\Domain\TShirtName;
use JacoBaldrich\TShirt\TShirts\Application\TShirtCreator;
use JacoBaldrich\TShirt\TShirts\Application\CreateTShirtCommand;

/**
 * Update Cheapest Variant Command Handler.
 */
final class UpdateCheapestVariantCommandHandler
{
	private $updater;

	public function __construct( CheapestVariantUpdater $updater )
	{
		$this->updater = $updater;
	}

	public function handle( UpdateCheapestVariantCommand $command ): void
	{
		$id   = new TShirtId( $command->id() );
		$name = new TShirtName( $command->name() );

		$this->updater->rename( $id, $name );
	}
}
