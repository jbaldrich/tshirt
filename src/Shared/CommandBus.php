<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\Shared;

use JacoBaldrich\TShirt\Shared\Command;

/**
 * Command Bus Interface.
 */
interface CommandBus
{
	/**
	 * Dispatch a command to a command handler.
	 *
	 * @param Command $command
	 * @return void
	 */
	public function dispatch( Command $command ): void;
}