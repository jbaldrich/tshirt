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
 * T-Shirt Rename Command.
 */
final class RenameTShirtCommand extends Command
{
	private $id;
	private $name;

	/**
	 * Constructor.
	 *
	 * @param UuidValueObject $commandId
	 * @param string $id
	 * @param string $name
	 */
	public function __construct( UuidValueObject $commandId, string $id, string $name )
	{
		parent::__construct( $commandId );

		$this->id   = $id;
		$this->name = $name;
	}

	public function id(): string
	{
		return $this->id;
	}

	public function name(): string
	{
		return $this->name;
	}
}
