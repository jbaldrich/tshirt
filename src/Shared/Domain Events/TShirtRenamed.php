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
 * T-shirt renamed domain event.
 */
class TShirtRenamed implements Event
{
	private $id;
	private $name;

	public function __construct( string $id, string $name )
	{
		$this->id = $id;
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
