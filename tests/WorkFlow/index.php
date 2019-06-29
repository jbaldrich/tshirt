<?php declare (strict_types = 1);

/**
 * T-shirts.
 *
 * @package   JacoBaldrich\TShirt
 * @author    Jaco Baldrich <hello@jacobaldrich.com>
 * @license   MIT
 */

namespace JacoBaldrich\TShirt\Tests\Unit;

use JacoBaldrich\TShirt\Shared\TShirtId;
use JacoBaldrich\TShirt\Shared\VariantId;
use JacoBaldrich\TShirt\Shared\UuidValueObject;
use JacoBaldrich\TShirt\TShirts\Domain\TShirtName;
use JacoBaldrich\TShirt\TShirts\Application\TShirtFinder;
use JacoBaldrich\TShirt\TShirts\Application\TShirtCreator;
use JacoBaldrich\TShirt\TShirts\Application\TShirtRenamer;
use JacoBaldrich\TShirt\Variants\Application\PriceChanger;
use JacoBaldrich\TShirt\Variants\Application\VariantFinder;
use JacoBaldrich\TShirt\TShirts\Application\FindTShirtQuery;
use JacoBaldrich\TShirt\Variants\Application\VariantCreator;
use JacoBaldrich\TShirt\TShirts\Domain\TShirtResponseConverter;
use JacoBaldrich\TShirt\Variants\Application\FindVariantsQuery;
use JacoBaldrich\TShirt\TShirts\Application\CreateTShirtCommand;
use JacoBaldrich\TShirt\TShirts\Application\RenameTShirtCommand;
use JacoBaldrich\TShirt\Variants\Application\ChangePriceCommand;
use JacoBaldrich\TShirt\Variants\Application\CreateVariantCommand;
use JacoBaldrich\TShirt\Variants\Domain\InMemoryVariantRepository;
use JacoBaldrich\TShirt\Variants\Domain\VariantsResponseConverter;
use JacoBaldrich\TShirt\TShirts\Application\FindTShirtQueryHandler;
use JacoBaldrich\TShirt\Variants\Application\ChangeOfferPriceCommand;
use JacoBaldrich\TShirt\Variants\Application\FindVariantsQueryHandler;
use JacoBaldrich\TShirt\TShirts\Application\CreateTShirtCommandHandler;
use JacoBaldrich\TShirt\TShirts\Application\RenameTShirtCommandHandler;
use JacoBaldrich\TShirt\Variants\Application\ChangePriceCommandHandler;
use JacoBaldrich\TShirt\TShirts\Infrastructure\InMemoryTShirtRepository;
use JacoBaldrich\TShirt\Variants\Application\CreateVariantCommandHandler;
use JacoBaldrich\TShirt\Variants\Application\ChangeOfferPriceCommandHandler;

include __DIR__ . '/../../vendor/autoload.php'; // composer autoload

/******* THIS FILE REPRODUCES EXPECTED WORKFLOW OF THE APPLICATION ********/

/** INDEX OF REPRODUCED USE CASES **/
/** -SET VARIABLES **/
/** -CREATE A T-SHIRT **/
/** --RENAME A T-SHIRT **/
/** -CREATE 3 VARIANTS **/
/** --QUERY ALL VARIANTS BY T-SHIRT ID **/
/** --UPDATE T-SHIRT **/
/** --CHANGE A VARIANT PRICE **/
/** --CHANGE A VARIANT OFFER PRICE **/
/** ---UPDATE T-SHIRT **/
/** -QUERY THE T-SHIRT **/

/** AT THE END OF THE FILE THE T-SHIRT IS DUMPED INCLUDING ALL THE EVENTS REGISTERED */
/** IT IS ALSO DUMPED THE T-SHIRT QUERY WITH ALL NECESSARY INFORMATION ABOUT THE T-SHIRT */

/** SET VARIABLES **/
$tShirtId = new TShirtId;
$tShirtName = new TShirtName('foo');
$tShirtNewName = new TShirtName('bar');
$concreteVariantId = new VariantId;

/** CREATE A T-SHIRT **/
$repository = new InMemoryTShirtRepository;
$creator = new TShirtCreator( $repository );
$createCommandHandler = new CreateTShirtCommandHandler( $creator );
$createCommand = new CreateTShirtCommand(
	new UuidValueObject,
	$tShirtId->value(),
	$tShirtName->value()
);
$createCommandHandler->handle( $createCommand );

/** RENAME A T-SHIRT **/
$renamer = new TShirtRenamer( $repository );
$renameCommandHandler = new RenameTShirtCommandHandler( $renamer );
$renameCommand = new RenameTShirtCommand(
	new UuidValueObject,
	$tShirtId->value(),
	$tShirtNewName->value()
);
$renameCommandHandler->handle( $renameCommand );

/** CREATE 3 VARIANTS **/
$variantRepository = new InMemoryVariantRepository();
$creator = new VariantCreator( $variantRepository );
$commandHandler = new CreateVariantCommandHandler( $creator );

$command = new CreateVariantCommand(
	new UuidValueObject,
	$tShirtId->value(),
	$concreteVariantId->value(),
	'M',
	3195
);
$commandHandler->handle( $command );

$command = new CreateVariantCommand(
	new UuidValueObject,
	$tShirtId->value(),
	(new UuidValueObject)->value(),
	'L',
	2595,
	2190
);
$commandHandler->handle( $command );

$command = new CreateVariantCommand(
	new UuidValueObject,
	$tShirtId->value(),
	'69175e7e-1e7d-4a27-ac3b-ff41e384aea8', // Cheapest Variant ID
	'S',
	1595,
	1095
);
$commandHandler->handle( $command );

/** --QUERY ALL VARIANTS BY T-SHIRT ID **/
$converter = new VariantsResponseConverter;
$finder = new VariantFinder( $variantRepository );
$queryHandler = new FindVariantsQueryHandler( $finder, $converter );

$query = new FindVariantsQuery(
	$tShirtId->value()
);
$response = $queryHandler->handle( $query );

/** UPDATE T-SHIRT **/
$product = $repository->find( $tShirtId );
$product->updateVariants( ...$response );

/** CHANGE A VARIANT PRICE **/
$priceChanger = new PriceChanger( $variantRepository );
$commandHandler = new ChangePriceCommandHandler( $priceChanger );

$command = new ChangePriceCommand(
	new UuidValueObject,
	$concreteVariantId->value(),
	995
);
$commandHandler->handle( $command );

/** CHANGE A VARIANT OFFER PRICE **/
$commandHandler = new ChangeOfferPriceCommandHandler( $priceChanger );

$command = new ChangeOfferPriceCommand(
	new UuidValueObject,
	$concreteVariantId->value(),
	795
);
$commandHandler->handle( $command );

/** UPDATE T-SHIRT **/
$query = new FindVariantsQuery(
	$tShirtId->value()
);
$response = $queryHandler->handle( $query );
$product->updateVariants( ...$response );

/** QUERY THE T-SHIRT **/
$tShirtConverter = new TShirtResponseConverter;
$tShirtFinder = new TShirtFinder( $repository );
$tShirtQueryHandler = new FindTShirtQueryHandler( $tShirtFinder, $tShirtConverter );

$query = new FindTShirtQuery(
	$tShirtId->value()
);
$response = $tShirtQueryHandler->handle( $query );

dump($product);
dump($response);

exit;