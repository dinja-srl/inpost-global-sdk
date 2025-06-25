<?php

namespace Dinja\InPostGlobalSDK\Request;

use Dinja\InPostGlobalSDK\Exception\InvalidJsonException;
use Dinja\InPostGlobalSDK\Exception\RequestException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

abstract class BaseRequest implements RequestInterface
{
    protected $accessToken;
    protected $clientId;
    protected $command = '';
    protected $method = 'POST';
    protected $endpointTest = 'https://sandbox-api.inpost-group.com';
    protected $endpointProd = '"https://api.inpost-group.com';
    protected $apiPath = '';
    protected $apiProperties = [];
    protected $mandatoryFields = [];

    public function __construct($clientId, $clientSecret, $debug = FALSE)
    {
        $client = new Client([
            'timeout' => 30.0
        ]);

        $authRequestBody = [
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'scope' => "openid",
            'grant_type' => "client_credentials"
        ];

        $response = $client->request('POST', ($debug ? $this->endpointTest : $this->endpointProd) . "/auth/token", ['form_params' => $authRequestBody]);
        $body = $response->getBody();
        $body = json_decode($response->getBody());

        if(isset($body->access_token)) {
            $this->accessToken = $body->access_token;
            $this->clientId = $clientId;
        } else {
            throw new InvalidJsonException($body->error_description, $body->error_codes[0]);
        }
    }

    /**
     * Performs http call to InPost Global API
     *
     * @throws GuzzleException
     * @throws InvalidJsonException|RequestException
     */
    public function call($debug = FALSE)
    {
        $client = new Client([
            'timeout' => 30.0
        ]);

        $response = $client->request($this->method, ($debug ? $this->endpointTest : $this->endpointProd) . $this->apiPath, [
            'headers'       => ['X-Request-Id' => uniqid(), 'Authorization' => 'Bearer ' . $this->accessToken],
            'json'          => $this->createRequestBody()
        ]);
        $response = json_decode($response->getBody());

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidJsonException(json_last_error_msg(), json_last_error());
        }

        return $response;
    }

    public function toArray()
    {
        return [[]];
    }

    public function createRequestBody()
    {
//        PHP 5.6+ only
//        $emptyMandatory = array_filter($this->toArray(), function ($v, $k) {
//            return in_array($k, $this->mandatoryFields) && (is_null($v) || $v === "");
//        }, 1);
        $arr = $this->toArray();
        $emptyMandatory = [];
        foreach ($arr[0] as $k => $v) {
            if (in_array($k, $this->mandatoryFields) && (is_null($v) || $v === "")) {
                $emptyMandatory[$k] = $v;
            }
        }
        if (count($emptyMandatory) > 0) {
            throw new RequestException(sprintf('Fields %s are mandatory', implode(', ', array_keys($emptyMandatory))));
        }

        return $arr[0];
    }

    /**
     * Get the value of apiPath
     */ 
    public function getApiPath()
    {
        return $this->apiPath;
    }

    /**
     * Set the value of apiPath
     *
     * @return  self
     */ 
    public function setApiPath($apiPath)
    {
        $this->apiPath = $apiPath;

        return $this;
    }
}
