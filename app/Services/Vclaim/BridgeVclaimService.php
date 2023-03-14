<?php

namespace App\Services\Vclaim;

use App\Services\Vclaim\ConfigVclaim;
use App\Services\Vclaim\ResponseVclaim;
use App\Services\CurlFactory;

class BridgeVclaimService extends CurlFactory
{
    protected $config;
    protected $response;
    protected $header;
    protected $headers;

    public function __construct()
    {
        // parent::__construct();
        $this->config = new ConfigVclaim;
        $this->response = new ResponseVclaim;
        $this->header = $this->config->setHeader();
    }

    public function getRequest($endpoint)
    {
        $result = $this->requestCurl($this->config->setUrl().'/'.$this->config->setUrlService().'/'.$endpoint, $this->header);
        $result = $this->response->responseVclaim($result, $this->config->keyDecrypt($this->header['X-timestamp']));
        return $result;
    }
}