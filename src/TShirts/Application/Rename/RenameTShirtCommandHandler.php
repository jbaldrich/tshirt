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
 * T-Shirt Renamer Command Handler.
 */
final class RenameTShirtCommandHandler
{
	private $tShirtRenamer;

	public function __construct( TShirtRenamer $tShirtRenamer )
	{
		$this->tShirtRenamer = $tShirtRenamer;
	}

	public function handle( RenameTShirtCommand $command ): void
	{
		$id   = new TShirtId( $command->id() );
		$name = new TShirtName( $command->name() );

		$this->tShirtRenamer->rename( $id, $name );
	}
}
