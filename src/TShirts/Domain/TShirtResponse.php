<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\TShirts\Domain;

/**
 * T-Shirt Response.
 */
final class TShirtResponse implements Response
{
	private $id;
	private $name;

	/**
	 * Constructor.
	 *
	 * @param string $id
	 * @param string $name
	 */
	public function __construct( string $id, string $name )
	{
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
