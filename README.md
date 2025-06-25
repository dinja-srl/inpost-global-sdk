# InPost PHP SDK

This package is a PHP SDK for InPost Global Rest API.

## Installing
Install with composer
```shell
composer require dinja/inpost-global-sdk
```

## Features
### Shipment Services
*   Create Address to Point Shipment
*   Create Address to Address Shipment
*   Create Point to Point Shipment
*   Create Point to Address Shipment
*   Get Label

## Usage
### Create Address to Point Shipment
```php
$debug = true;
$timestamp = new \DateTime();
$timezone = new \DateTimeZone('Europe/Rome');
$timestamp->setTimezone($timezone);

$recipient = new ShipmentContact();
$recipient->setFirstName("Mario")
    ->setLastName("Rossi")
    ->setPhonePrefix("+39")
    ->setPhoneNumber("0803009954")
    ->setEmail("info@sellengine.it");

$sender = new ShipmentContact();
$sender->setCompanyName("Dinja Srl")
    ->setPhonePrefix("+39")
    ->setPhoneNumber("0803009954")
    ->setEmail("info@sellengine.it");

$origin = new ShipmentAddress();
$origin->setStreet("Via Leonardo da Vinci")
    ->setHouseNumber("22")
    ->setCity("Polignano a Mare")
    ->setPostalCode("70044")
    ->setCountryCode("IT");

$destination = new ShipmentPoint();
$destination->setCountryCode("IT")
    ->setPointName("AAATESTPOK9");

$parcel = new ShipmentParcel();
$parcel->setWeightAmount("1")
    ->setWeightUnit("KG")
    ->setHeight("1")
    ->setLength("1")
    ->setWidth("1")
    ->setDimensionsUnit("CM");

$shipment = new Shipment();
$shipment->setSender($sender)
    ->setRecipient($recipient)
    ->setOriginAddress($origin)
    ->setDestinationPoint($destination)
    ->setParcel($parcel);

$request = new ShipmentRequest("inpost_api_client_id", "inpost_api_client_secret", $debug);
$request->setLabelFormat("PDF_URL")
    ->setShipment($shipment);

$shipmentResponse = $request->call();

if ($shipmentResponse->hasError()) {
    echo $shipmentResponse->getTitle();
} else {
    $shipmentLabelUrl = $shipmentResponse->getLabel();
}
```

### Get PDF Label
```php
$debug = true;

$request = new LabelRequest("inpost_api_client_id", "inpost_api_client_secret", $debug);
$request->setApiPath($shipmentLabelUrl);

$response = $request->call();

if ($response->hasError()) {
    echo $response->getStatus();
} else {
    $pdfLabel = base64_decode($response->getLabel());
}
```

### Get ZPL Label
```php
$debug = true;

$request = new LabelRequest("inpost_api_client_id", "inpost_api_client_secret", $debug);
$request->setApiPath($shipmentLabelUrl);
$request->setLabelFormat("ZPL");

$response = $request->call();

if ($response->hasError()) {
    echo $response->getStatus();
} else {
    $zplLabel = base64_decode($response->getLabel());
}
```

## Credits

- [Dinja Srl][link-author]
- [All Contributors][link-contributors]

## License

This project is licensed under the MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[link-author]: https://github.com/dinja-srl
[link-contributors]: ../../contributors
