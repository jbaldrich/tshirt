<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\Shared;

/**
 * Variants updated domain event.
 */
class VariantsUpdated implements Event
{
	private $id;
	private $data;

	public function __construct( string $id, array $data )
	{
		$this->id = $id;
		$this->data = $data;
	}

	public function id(): string
	{
		return $this->id;
	}

	public function data(): array
	{
		return $this->data;
	}
}
