<?php

namespace App\Services\Antrol;

use LZCompressor\LZString;
use App\Services\GenerateBpjsService;

class ResponseAntrol
{
    public function responseAntrol($response, $key)
    {
        $result = json_decode($response);
        if(!empty($result)){
            if (($result->metadata->code == "200" || $result->metadata->code = "1") && isset($result->response) && is_string($result->response)) {
                return self::doMaping($result->metadata, $result->response, $key);
            }
        }else{
            $result = [];
        }
        return json_encode($result);
    }

    public function doMaping($metadata, $response, $key)
    {
        $data = [
            "metadata" => $metadata,
            "response" => json_decode($this->decompressed(GenerateBpjsService::stringDecrypt($key, $response)))
        ];
		return json_encode($data);
    }

    protected function decompressed($dataString)
    {
        return LZString::decompressFromEncodedURIComponent($dataString);
    }
}