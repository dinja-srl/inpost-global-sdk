<?php

namespace Dinja\InPostGlobalSDK\Api;

class Shipment
{
    /** @var ShipmentContact */
    private $sender;

    /** @var ShipmentContact */
    private $recipient;

    /** @var ShipmentAddress */
    private $originAddress;

    /** @var ShipmentPoint */
    private $originPoint;

    /** @var ShipmentPoint */
    private $destinationPoint;

    /** @var ShipmentAddress */
    private $destinationAddress;

    /** @var string */
    private $priority = 'STANDARD';

    /** @var ShipmentParcel */
    private $parcel;

    public function toArray()
    {
        return [
            'sender' => $this->sender->toArray(),
            'recipient' => $this->recipient->toArray(),
            'origin' => !is_null($this->originAddress) ? $this->originAddress->toArray() : $this->originPoint->toArray(),
            'destination' => !is_null($this->destinationPoint) ? $this->destinationPoint->toArray() : $this->destinationAddress->toArray(),
            'priority' => $this->priority,
            'parcel' => $this->parcel->toArray()
        ];
    }

    /**
     * Get the value of sender
     */ 
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set the value of sender
     *
     * @return  self
     */ 
    public function setSender($sender)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get the value of recipient
     */ 
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * Set the value of recipient
     *
     * @return  self
     */ 
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;

        return $this;
    }

    /**
     * Get the value of originAddress
     */ 
    public function getOriginAddress()
    {
        return $this->originAddress;
    }

    /**
     * Set the value of originAddress
     *
     * @return  self
     */ 
    public function setOriginAddress($originAddress)
    {
        $this->originAddress = $originAddress;

        return $this;
    }

    /**
     * Get the value of destinationPoint
     */ 
    public function getDestinationPoint()
    {
        return $this->destinationPoint;
    }

    /**
     * Set the value of destinationPoint
     *
     * @return  self
     */ 
    public function setDestinationPoint($destinationPoint)
    {
        $this->destinationPoint = $destinationPoint;

        return $this;
    }

    /**
     * Get the value of priority
     */ 
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set the value of priority
     *
     * @return  self
     */ 
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get the value of parcel
     */ 
    public function getParcel()
    {
        return $this->parcel;
    }

    /**
     * Set the value of parcel
     *
     * @return  self
     */ 
    public function setParcel($parcel)
    {
        $this->parcel = $parcel;

        return $this;
    }

    /**
     * Get the value of originPoint
     */ 
    public function getOriginPoint()
    {
        return $this->originPoint;
    }

    /**
     * Set the value of originPoint
     *
     * @return  self
     */ 
    public function setOriginPoint($originPoint)
    {
        $this->originPoint = $originPoint;

        return $this;
    }

    /**
     * Get the value of destinationAddress
     */ 
    public function getDestinationAddress()
    {
        return $this->destinationAddress;
    }

    /**
     * Set the value of destinationAddress
     *
     * @return  self
     */ 
    public function setDestinationAddress($destinationAddress)
    {
        $this->destinationAddress = $destinationAddress;

        return $this;
    }
}
