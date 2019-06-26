<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\Shared;

use JacoBaldrich\TShirt\Shared\UuidValueObject;

/**
 * Base Command.
 */
abstract class Command
{
	private $commandId;

	/**
	 * Constructor.
	 *
	 * @param UuidValueObject $id
	 */
	public function __construct( UuidValueObject $commandId )
	{
		$this->commandId = $commandId;
	}

	public function commandId(): UuidValueObject
	{
		return $this->commandId;
	}

	public function stringCommandId(): string
	{
		return $this->commandId->value();
	}
}
