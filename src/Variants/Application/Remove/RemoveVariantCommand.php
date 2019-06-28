<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\TShirts\Application;

use JacoBaldrich\TShirt\Shared\Command;
use JacoBaldrich\TShirt\Shared\UuidValueObject;

/**
 * Variant Remover Command.
 */
final class RemoveVariantCommand extends Command
{
	private $id;

	/**
	 * Constructor.
	 *
	 * @param UuidValueObject $commandId
	 * @param string $id
	 */
	public function __construct( UuidValueObject $commandId, string $id )
	{
		parent::__construct( $commandId );

		$this->id = $id;
	}

	public function id(): string
	{
		return $this->id;
	}
}
