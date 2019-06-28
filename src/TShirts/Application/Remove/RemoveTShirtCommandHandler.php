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
use JacoBaldrich\TShirt\TShirts\Application\TShirtRemover;
use JacoBaldrich\TShirt\TShirts\Application\RemoveTShirtCommand;

/**
 * T-Shirt Remover Command Handler.
 */
final class RemoveTShirtCommandHandler
{
	private $tShirtRemover;

	public function __construct( TShirtRemover $tShirtRemover )
	{
		$this->tShirtRemover = $tShirtRemover;
	}

	public function handle( RemoveTShirtCommand $command ): void
	{
		$id = new TShirtId( $command->id() );

		$this->tShirtRemover->remove( $id );
	}
}
