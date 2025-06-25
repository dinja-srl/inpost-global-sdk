<?php

namespace Dinja\InPostGlobalSDK\Response;

class LabelResponse extends BaseResponse
{

     /**
     * @var string
     */
    protected $label;

    public function __construct($response)
    {
        foreach ($response as $key => $value) {
            if (property_exists($this, $key)) {
                switch ($key) {
                    case 'label':
                        $value = $value->content;
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
}
