<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\Tests\Unit\Shared;

use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

/**
 * Abstract Test Base class.
 */
abstract class TestBase extends TestCase
{
	use \Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

	protected function mock( $className ): MockInterface
	{
		return Mockery::mock( $className );
	}

	protected function anInstanceOf( $className )
	{
		return Mockery::type( $className );
	}

	protected function tearDown(): void
	{
		Mockery::close();
		parent::tearDown();
	}
}