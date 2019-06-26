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
 * Variant Creator Command.
 */
final class CreateVariantCommand extends Command
{
	private $tShirtId;
	private $id;
	private $size;
	private $price;
	private $offerPrice;

	/**
	 * Constructor.
	 *
	 * @param UuidValueObject $commandId
	 * @param string $tShirtId
	 * @param string $id
	 * @param string $size
	 * @param int $price
	 * @param int|null $offerPrice
	 */
	public function __construct(
		UuidValueObject $commandId,
		string $tShirtId,
		string $id,
		string $size,
		int $price,
		?int $offerPrice = null
	)
	{
		parent::__construct( $commandId );

		$this->tShirtId   = $tShirtId;
		$this->id         = $id;
		$this->size       = $size;
		$this->price      = $price;
		$this->offerPrice = $offerPrice;
	}

	public function tShirtId(): string
	{
		return $this->tShirtId;
	}

	public function id(): string
	{
		return $this->id;
	}

	public function size(): string
	{
		return $this->size;
	}

	public function price(): int
	{
		return $this->price;
	}

	public function offerPrice(): ?int
	{
		return $this->offerPrice;
	}
}
