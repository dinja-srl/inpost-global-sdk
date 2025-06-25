<?php

namespace Dinja\InPostGlobalSDK\Response;

class ShipmentResponse extends BaseResponse
{

    /**
     * @var string
     */
    protected $label;

    /**
     * @var string
     */
    protected $uuid;

    /**
     * @var string
     */
    protected $trackingNumber;

    public function __construct($response)
    {
        foreach ($response as $key => $value) {
            if (property_exists($this, $key)) {
                switch ($key) {
                    case 'label':
                        $value = $value->url;
                        break;
                }
                $this->{$key} = $value;
            }
        }
    }

    /**
     * Get the value of label
     *
     * @return  string
     */ 
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set the value of label
     *
     * @param  string  $label
     *
     * @return  self
     */ 
    public function setLabel(string $label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get the value of uuid
     *
     * @return  string
     */ 
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Set the value of uuid
     *
     * @param  string  $uuid
     *
     * @return  self
     */ 
    public function setUuid(string $uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * Get the value of trackingNumber
     *
     * @return  string
     */ 
    public function getTrackingNumber()
    {
        return $this->trackingNumber;
    }

    /**
     * Set the value of trackingNumber
     *
     * @param  string  $trackingNumber
     *
     * @return  self
     */ 
    public function setTrackingNumber(string $trackingNumber)
    {
        $this->trackingNumber = $trackingNumber;

        return $this;
    }
}
