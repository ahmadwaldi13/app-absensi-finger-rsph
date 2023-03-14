<?php

namespace App\Services\Antrol;

use App\Services\GenerateBpjsService;

class ConfigAntrol extends \App\Services\BaseService
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
        $this->urlEndpoint = getenv('API_BPJS_ANTROL');
        $this->urlEndpointService = getenv('SERVISCE_ANTROL');
        $this->consId = getenv('CONS_ID');
        $this->secretKey = getenv('SECRET_KEY');
        $this->userKey = getenv('USER_KEY_ANTROL');

        $this->header = $this->setHeader();
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

   public function setHeader()
	{
		return [
			'X-cons-id'   => $this->setConsid(),
			'X-timestamp' => $this->setTimestamp(),
			'X-signature' => $this->setSignature(),
			'user_key'    => $this->setUserKey()
		];
	}

   public function keyDecrypt() 
   {
      return $this->setConsid().$this->setSecretKey().$this->header['X-timestamp'];
   }
}