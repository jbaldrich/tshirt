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
 * Query Bus Interface.
 */
interface QueryBus
{
	/**
	 * Ask a query to a query handler.
	 *
	 * @param Query $query
	 * @return Response|null
	 */
	public function ask( Query $query ): ?Response;
}
