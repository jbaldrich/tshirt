<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\Tests\Unit\TShirts\Application;

use JacoBaldrich\TShirt\Shared\VariantId;
use JacoBaldrich\TShirt\Shared\UuidValueObject;
use JacoBaldrich\TShirt\Tests\Unit\Shared\TestBase;
use JacoBaldrich\TShirt\Variants\Domain\VariantRepository;
use JacoBaldrich\TShirt\Variants\Application\VariantCreator;
use JacoBaldrich\TShirt\Variants\Application\VariantRemover;
use JacoBaldrich\TShirt\Variants\Application\CreateVariantCommand;
use JacoBaldrich\TShirt\Variants\Application\RemoveVariantCommand;
use JacoBaldrich\TShirt\Variants\Domain\InMemoryVariantRepository;
use JacoBaldrich\TShirt\Variants\Application\CreateVariantCommandHandler;
use JacoBaldrich\TShirt\Variants\Application\RemoveVariantCommandHandler;

/**
 * Tests for remove a Variant use case.
 */
final class RemoveVariantTest extends TestBase
{
	private $repository;
	private $remover;
	private $handler;

	protected function setUp(): void
	{
		parent::setUp();
		$this->repository = $this->mock( VariantRepository::class );
		$this->remover = new VariantRemover( $this->repository );
		$this->handler = new RemoveVariantCommandHandler( $this->remover );
	}

	public function test_throws_an_exception_when_trying_to_remove_a_non_existing_variant()
	{
		$command = new RemoveVariantCommand(
			new UuidValueObject,
			'25769c6c-d34d-4bfe-ba98-e0ee856f3e7a',
			'name'
		);

		$this->repository->expects()
			->find( $this->anInstanceOf( VariantId::class ) )
			->andReturn();
		$this->expectException(\Exception::class);

		$this->handler->handle( $command );
	}

	public function test_removes_a_variant()
	{
		// Ensure variant is created.
		$variantId = '25769c6c-d34d-4bfe-ba98-e0ee856f3e7a';
		$repository = new InMemoryVariantRepository;
		$creator = new VariantCreator( $repository );
		$creatorHandler = new CreateVariantCommandHandler( $creator );
		$createCommand = new CreateVariantCommand(
			new UuidValueObject,
			(new UuidValueObject)->value(),
			$variantId,
			'M',
			1099
		);
		$creatorHandler->handle( $createCommand );

		// Test removing:
		// Given:
		$remover = new VariantRemover( $repository );
		$handler = new RemoveVariantCommandHandler( $remover );
		$command = new RemoveVariantCommand(
			new UuidValueObject,
			$variantId
		);
		// When:
		$handler->handle( $command );
		// Then:
		$this->assertFalse(
			array_key_exists(
				$variantId,
				$repository
			)
		);
	}
}
