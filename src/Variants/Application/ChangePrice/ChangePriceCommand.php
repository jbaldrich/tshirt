<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\Variants\Application;

use JacoBaldrich\TShirt\Shared\Command;
use JacoBaldrich\TShirt\Shared\UuidValueObject;

/**
 * Change Variant price Command.
 */
final class ChangePriceCommand extends Command
{
	private $id;
	private $price;

	/**
	 * Constructor.
	 *
	 * @param UuidValueObject $commandId
	 * @param string $id
	 * @param int $price
	 */
	public function __construct( UuidValueObject $commandId, string $id, int $price )
	{
		parent::__construct( $commandId );

		$this->id = $id;
		$this->price = $price;
	}

	public function id(): string
	{
		return $this->id;
	}

	public function price(): int
	{
		return $this->price;
	}
}
