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
 * Aggregate Root abstract class.
 */
abstract class AggregateRoot
{
	/**
	 * Events
	 *
	 * @var array
	 */
	protected $events = [];

	/**
	 * Record a domain event.
	 *
	 * @param Event $event
	 * @return void
	 */
	protected function record( Event $event ): void
	{
		$this->events[] = $event;
	}

	/**
	 * Pull all domain events.
	 *
	 * @return Events
	 */
	public function pullDomainEvents(): Events
	{
		$events = $this->events;
		$this->events = [];
		return $events;
	}
}
