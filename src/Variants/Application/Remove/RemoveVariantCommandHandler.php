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
use JacoBaldrich\TShirt\Variants\Application\VariantRemover;
use JacoBaldrich\TShirt\Variants\Application\RemoveVariantCommand;

/**
 * Variant Remover Command Handler.
 */
final class RemoveVariantCommandHandler
{
	private $remover;

	public function __construct( VariantRemover $remover )
	{
		$this->remover = $remover;
	}

	public function handle( RemoveVariantCommand $command ): void
	{
		$id = new VariantId( $command->id() );

		$this->remover->remove( $id );
	}
}
