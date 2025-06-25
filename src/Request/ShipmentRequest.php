<?php

namespace Dinja\InPostGlobalSDK\Request;

use Dinja\InPostGlobalSDK\Api\Shipment;
use Dinja\InPostGlobalSDK\Response\ShipmentResponse;

class ShipmentRequest extends BaseRequest
{
    protected $method = 'POST';
    protected $serviceType = 'A2P'; // A2P = address to point; A2A = address to address
    protected $mandatoryFields = [
        'labelFormat',
        'shipment'
    ];

    /**
     * @var string
     */
    private $labelFormat;

    /**
     * @var Shipment
     */
    private $shipment;


    public function call()
    {
        switch($this->serviceType) {
            case 'A2P':
                $this->apiPath = '/shipments/address-to-point';
                break;
            case 'A2A':
                $this->apiPath = '/shipments/address-to-address';
                break;
            case 'P2P':
                $this->apiPath = '/shipments/point-to-point';
                break;
            case 'P2A':
                $this->apiPath = '/shipments/point-to-address';
                break;
        }

        return new ShipmentResponse(parent::call());
    }

    public function toArray()
    {
        return array_filter([
            array_filter([
                'labelFormat' => $this->labelFormat,
                'shipment' => $this->shipment->toArray()], function ($v) { return !is_null($v); })
        ], function ($v) {
            return !is_null($v);
        });
    }

    /**
     * Get the value of labelFormat
     *
     * @return  string
     */ 
    public function getLabelFormat()
    {
        return $this->labelFormat;
    }

    /**
     * Set the value of labelFormat
     *
     * @param  string  $labelFormat
     *
     * @return  self
     */ 
    public function setLabelFormat(string $labelFormat)
    {
        $this->labelFormat = $labelFormat;

        return $this;
    }

    /**
     * Get the value of shipment
     *
     * @return  Shipment
     */ 
    public function getShipment()
    {
        return $this->shipment;
    }

    /**
     * Set the value of shipment
     *
     * @param  Shipment  $shipment
     *
     * @return  self
     */ 
    public function setShipment(Shipment $shipment)
    {
        $this->shipment = $shipment;

        return $this;
    }

    /**
     * Get the value of serviceType
     */ 
    public function getServiceType()
    {
        return $this->serviceType;
    }

    /**
     * Set the value of serviceType
     *
     * @return  self
     */ 
    public function setServiceType($serviceType)
    {
        $this->serviceType = $serviceType;

        return $this;
    }
}
