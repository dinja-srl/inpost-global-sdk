<?php

namespace Dinja\InPostGlobalSDK\Request;

use Dinja\InPostGlobalSDK\Response\LabelResponse;
use Dinja\InPostGlobalSDK\Exception\InvalidJsonException;
use Dinja\InPostGlobalSDK\Exception\RequestException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class LabelRequest extends BaseRequest
{
    protected $method = 'GET';
    protected $apiPath = '';
    protected $labelFormat = 'PDF'; // PDF / ZPL

    /**
     * Performs http call to InPost Global API
     *
     * @throws GuzzleException
     * @throws InvalidJsonException|RequestException
     */
    public function call()
    {
        $client = new Client([
            'timeout' => 30.0
        ]);

        $response = $client->request($this->method, $this->apiPath, [
            'headers'       => ['X-Request-Id' => uniqid(), 'Authorization' => 'Bearer ' . $this->accessToken, 'Accept' => $this->labelFormat == 'ZPL' ? 'text/zpl;dpi=203' : '*/*']
        ]);
        $response = json_decode($response->getBody());

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidJsonException(json_last_error_msg(), json_last_error());
        }

        return new LabelResponse($response);
    }

    /**
     * Get the value of labelFormat
     */ 
    public function getLabelFormat()
    {
        return $this->labelFormat;
    }

    /**
     * Set the value of labelFormat
     *
     * @return  self
     */ 
    public function setLabelFormat($labelFormat)
    {
        $this->labelFormat = $labelFormat;

        return $this;
    }
}
