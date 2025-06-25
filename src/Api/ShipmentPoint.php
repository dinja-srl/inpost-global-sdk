<?php

namespace Dinja\InPostGlobalSDK\Api;

class ShipmentPoint
{
    /** @var string */
    private $countryCode;

    /** @var string */
    private $pointName;

    /** @var array */
    private $shippingMethods;

    public function toArray()
    {
        return [
            'countryCode' => $this->countryCode,
            'pointName' => $this->pointName,
            'shippingMethods' => $this->shippingMethods
        ];
    }

    /**
     * Get the value of countryCode
     */ 
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * Set the value of countryCode
     *
     * @return  self
     */ 
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * Get the value of pointName
     */ 
    public function getPointName()
    {
        return $this->pointName;
    }

    /**
     * Set the value of pointName
     *
     * @return  self
     */ 
    public function setPointName($pointName)
    {
        $this->pointName = $pointName;

        return $this;
    }

    /**
     * Get the value of shippingMethods
     */ 
    public function getShippingMethods()
    {
        return $this->shippingMethods;
    }

    /**
     * Set the value of shippingMethods
     *
     * @return  self
     */ 
    public function setShippingMethods($shippingMethods)
    {
        $this->shippingMethods = $shippingMethods;

        return $this;
    }
}
