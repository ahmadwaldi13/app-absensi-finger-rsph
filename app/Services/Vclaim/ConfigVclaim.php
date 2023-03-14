<?php

namespace App\Services\Vclaim;

use App\Services\GenerateBpjsService;

class ConfigVclaim extends \App\Services\BaseService
{
    protected $urlEndpoint;
    protected $urlEndpointService;
    protected $consId;
    protected $secretKey;
    protected $userKey;
    protected $header;
    protected $timestamps;

    public function __construct()
    {

        $this->urlEndpoint = getenv('VCLAIM_URL');
        $this->urlEndpointService = getenv('VCLAIM_SERVISCE');
        $this->consId = getenv('VCLAIM_CONS_ID');
        $this->secretKey = getenv('VCLAIM_SECRETKEY');
        $this->userKey = getenv('VCLAIM_USER_KEY');
    }

    public function setUrl()
    {
       return $this->urlEndpoint; 
    }

    public function setUrlService()
    {
       return $this->urlEndpointService; 
    }

    public function setConsId()
    {
       return $this->consId; 
    }

    public function setSecretKey()
    {
       return $this->secretKey; 
    }

    public function setUserKey()
    {
       return $this->userKey; 
    }

    public function setTimestamp()
    {
        return GenerateBpjsService::bpjsTimestamp();
    }

    public function setsignature()
    {
        return GenerateBpjsService::generateSignature($this->setConsId(), $this->setSecretKey());
    }

    public function setUrlEncode()
	{
		return array('Content-Type' => 'Application/x-www-form-urlencoded');
	}

	public function setUrlJson()
	{
		return array('Content-Type' => 'Application/Json');
	}

    public function setHeader()
	{
		return [
            'Accept' => 'application/json',
			'X-cons-id'   => $this->setConsid(),
			'X-timestamp' => $this->setTimestamp(),
			'X-signature' => $this->setSignature(),
			'user_key'    => $this->setUserKey()
		];
	}

    public function keyDecrypt($timestamp) 
    {
        return $this->setConsid().$this->setSecretKey().$timestamp;
    }

    public function setHeaders($header)
    {
        return array_merge($header, $this->setUrlEncode());
    }
}