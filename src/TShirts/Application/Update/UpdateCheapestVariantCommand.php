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
 * Update cheapest variant Command.
 */
final class UpdateCheapestVariantCommand extends Command
{
	private $id;
	private $variantId;

	/**
	 * Constructor.
	 *
	 * @param UuidValueObject $commandId
	 * @param string $id
	 * @param string $variantId
	 */
	public function __construct( UuidValueObject $commandId, string $id, string $variantId )
	{
		parent::__construct( $commandId );

		$this->id = $id;
		$this->variantId = $variantId;
	}

	public function id(): string
	{
		return $this->id;
	}

	public function varaintId(): string
	{
		return $this->variantId;
	}
}
