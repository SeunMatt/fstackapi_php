<?php

/**
 * Created by PhpStorm.
 * User: smatt
 * Date: 22/06/2017
 * Time: 01:32 PM
 */
namespace FormStack;


use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class FSClient
{

    protected $token;
    protected $baseUrl;
    protected $client;
    protected $xmlResponseType;

    public function __construct($token = null, $baseUrl = null, $xmlResponseType = false) {

        if(is_null($token)) $token = config("formstack.access_token");
        if(is_null($baseUrl)) $baseUrl = config("formstack.base_url");

        $this->token = $token;
        $this->baseUrl = $baseUrl;
        $this->xmlResponseType = $xmlResponseType;

        $this->verifyTokenIsSet();

        $headerOptions = [
            "Authorization" => "Bearer ".$this->token,
        ];

        $this->client = new Client([
            "base_uri" => $this->baseUrl,
            "headers" => $headerOptions
        ]);

    }


    public function log() {
        return "baseUri = $this->baseUrl \ntoken = $this->token";
    }


    private function verifyTokenIsSet() {
        if(is_null($this->token))
            throw new TokeNotSetException("Formstack Access Token Not Set");
    }

    /**
     * @return mixed|null
     */
    public function getToken() {
        return $this->token;
    }

    /**
     * @param mixed|null $token
     */
    public function setToken($token) {
        $this->token = $token;
    }

    /**
     * @return mixed|null
     */
    public function getBaseUrl() {
        return $this->baseUrl;
    }

    /**
     * @param mixed|null $baseUrl
     */
    public function setBaseUrl($baseUrl) {
        $this->baseUrl = $baseUrl;
    }



}