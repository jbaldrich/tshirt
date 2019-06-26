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
 * T-Shirt Creator Command Handler.
 */
final class CreateTShirtCommandHandler
{
	private $tShirtCreator;

	public function __construct( TShirtCreator $tShirtCreator )
	{
		$this->tShirtCreator = $tShirtCreator;
	}

	public function handle( CreateTShirtCommand $command ): void
	{
		$id   = new TShirtId( $command->id() );
		$name = new TShirtName( $command->name() );

		$this->tShirtCreator->create( $id, $name );
	}
}
