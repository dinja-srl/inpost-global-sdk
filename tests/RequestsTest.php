<?php

namespace Tests;

use Dinja\InPostGlobalSDK\Request\ShipmentRequest;
use Dinja\InPostGlobalSDK\Request\LabelRequest;

use Dinja\InPostGlobalSDK\Api\Shipment;
use Dinja\InPostGlobalSDK\Api\ShipmentContact;
use Dinja\InPostGlobalSDK\Api\ShipmentAddress;
use Dinja\InPostGlobalSDK\Api\ShipmentParcel;
use Dinja\InPostGlobalSDK\Api\ShipmentPoint;

use PHPUnit\Framework\TestCase;

class RequestsTest extends TestCase
{
    const inpost_api_client_id = "TBD";
    const inpost_api_client_secret = "TBD";
    const debug = true;

    public function testHasCorrectStructure()
    {
        $request = $this->buildRequestAddressToPoint();

        $body = $request->createRequestBody();

        $this->assertArrayHasKey('shipment', $body);
    }

    private function buildRequestAddressToPoint()
    {
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

        $request = new ShipmentRequest(self::inpost_api_client_id, self::inpost_api_client_secret, self::debug);
        $request->setLabelFormat("PDF_URL")
            ->setShipment($shipment);

        return $request;
    }

    public function testShipmentAddressToPointSuccessful()
    {
        $request = $this->buildRequestAddressToPoint();

        $response = $request->call(self::debug);

        $this->assertInstanceOf('Dinja\InPostGlobalSDK\Response\ShipmentResponse', $response);
        $this->assertTrue($response->getStatus() == "CREATED");
        $this->assertFalse($response->hasError());

        return $response;
    }

    /**
     * This test depends on `testShipmentAddressToPointSuccessful` and receives its return value.
     *
     * @depends testShipmentAddressToPointSuccessful
     */
    public function testGetLabelSuccessful(\Dinja\InPostGlobalSDK\Response\ShipmentResponse $shipmentResponse)
    {

        // Ensure the previous test passed and returned a valid response
        $this->assertFalse($shipmentResponse->hasError());
        $this->assertNotNull($shipmentResponse->getLabel(), "Shipment Label should not be null from previous test.");

        $request = new LabelRequest(self::inpost_api_client_id, self::inpost_api_client_secret, self::debug);
        $request->setApiPath($shipmentResponse->getLabel());

        $response = $request->call(self::debug);
        $this->assertInstanceOf('Dinja\InPostGlobalSDK\Response\LabelResponse', $response);

        return $response;
    }
}
