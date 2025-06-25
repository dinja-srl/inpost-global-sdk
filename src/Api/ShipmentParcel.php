<?php

namespace Dinja\InPostGlobalSDK\Api;

class ShipmentParcel
{
    /** @var string */
    private $type = 'STANDARD';

    /** @var string */
    private $length;

    /** @var string */
    private $width;

    /** @var string */
    private $height;

    /** @var string */
    private $dimensionsUnit;

    /** @var string */
    private $weightAmount;

    /** @var string */
    private $weightUnit;

    public function toArray()
    {
        return [
            'type' => $this->type,
            'dimensions' => [
                'length' => $this->length,
                'width' => $this->width,
                'height' => $this->height,
                'unit' => $this->dimensionsUnit
                ],
            'weight' => [
                'amount' => $this->weightAmount,
                'unit' => $this->weightUnit
            ]
        ];
    }

    /**
     * Get the value of type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of length
     */ 
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set the value of length
     *
     * @return  self
     */ 
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get the value of width
     */ 
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set the value of width
     *
     * @return  self
     */ 
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get the value of height
     */ 
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set the value of height
     *
     * @return  self
     */ 
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get the value of dimensionsUnit
     */ 
    public function getDimensionsUnit()
    {
        return $this->dimensionsUnit;
    }

    /**
     * Set the value of dimensionsUnit
     *
     * @return  self
     */ 
    public function setDimensionsUnit($dimensionsUnit)
    {
        $this->dimensionsUnit = $dimensionsUnit;

        return $this;
    }

    /**
     * Get the value of weightAmount
     */ 
    public function getWeightAmount()
    {
        return $this->weightAmount;
    }

    /**
     * Set the value of weightAmount
     *
     * @return  self
     */ 
    public function setWeightAmount($weightAmount)
    {
        $this->weightAmount = $weightAmount;

        return $this;
    }

    /**
     * Get the value of weightUnit
     */ 
    public function getWeightUnit()
    {
        return $this->weightUnit;
    }

    /**
     * Set the value of weightUnit
     *
     * @return  self
     */ 
    public function setWeightUnit($weightUnit)
    {
        $this->weightUnit = $weightUnit;

        return $this;
    }
}
