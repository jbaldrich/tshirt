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
 * T-shirt created domain event.
 */
class TShirtCreated implements Event
{
	public function __construct( string $id, string $name )
	{
		
	}
}
