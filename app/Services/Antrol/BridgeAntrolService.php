<?php

namespace App\Services\Antrol;

use App\Services\Antrol\ConfigAntrol;
use App\Services\Antrol\ResponseAntrol;
use App\Services\CurlFactory;

class BridgeAntrolService extends CurlFactory
{
    protected $config;
    protected $response;
    protected $header;
    protected $headers;
    public function __construct()
    {
        $this->config = new ConfigAntrol;
        $this->curlFactory = new CurlFactory;
        $this->response = new ResponseAntrol;
        $this->header = $this->config->setHeader();
    }

    public function getRequest($endpoint)
    {
        $result = $this->requestCurl($this->config->setUrl().'/'.$this->config->setUrlService().'/'.$endpoint, $this->header);
        $result = $this->response->responseAntrol($result, $this->config->keyDecrypt($this->header['X-timestamp']));
        return $result;
    }

    public function postRequest($endpoint, $data)
    {
        $result = $this->requestCurl($this->config->setUrl().'/'.$this->config->setUrlService().'/'.$endpoint, $this->header, "POST", $data);
        $result = $this->response->responseAntrol($result, $this->config->keyDecrypt($this->header['X-timestamp']));
        return $result;
    }

}