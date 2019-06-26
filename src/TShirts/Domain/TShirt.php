<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\TShirts\Domain;

use JacoBaldrich\TShirt\Shared\TShirtId;
use JacoBaldrich\TShirt\TShirts\Domain\TShirtName;

/**
 * Entity T-Shirt.
 */
final class TShirt
{
	/**
	 * @var TShirtId
	 */
	private $id;

	/**
	 * @var TShirtName
	 */
	private $name;

	/**
	 * Constructor.
	 *
	 * @param TShirtId $id
	 * @param TShirtName $name
	 */
	public function __construct( TShirtId $id, TShirtName $name )
	{
		$this->id = $id;
		$this->name = $name;
	}

	public function id(): TShirtId
	{
		return $this->id;
	}

	public function name(): TShirtName
	{
		return $this->name;
	}
}
