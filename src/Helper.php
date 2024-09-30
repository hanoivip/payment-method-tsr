<?php

namespace Hanoivip\PaymentMethodTsr;

use Illuminate\Support\Facades\Log;
use Hanoivip\CurlHelper;
use Exception;

class Helper implements IHelper
{   
    const CHARGE_COMMAND = "charging";
    const CHECK_COMMAND = "check";
    
    public function charge($partnerId, $partnerSecret, 
        $serial, $password, $telco, $dvalue, $mapping)
    {
        return $this->request(self::CHARGE_COMMAND, $partnerId, $partnerSecret, 
            $serial, $password, $telco, $dvalue, $mapping);
    }
    
    private function sign($params, $key)
    {
        ksort($params);
        $sign = $key;
        foreach ($params as $item) {
            $sign .= $item;
        }
        return md5($sign);
    }
    
    public function check($partnerId, $partnerSecret,
        $serial, $password, $telco, $dvalue, $mapping)
    {
        return $this->request(self::CHECK_COMMAND, $partnerId, $partnerSecret,
            $serial, $password, $telco, $dvalue, $mapping);
    }
    
    private function request($cmd, $partnerId, $partnerSecret,
        $serial, $password, $telco, $dvalue, $mapping)
    {
        $data = [
            'telco' => $telco,
            'code' => $password,
            'serial' => $serial,
            'partner_id' => $partnerId,
            'command' => $cmd,
            'request_id' => $mapping
        ];
        $data['sign'] = $this->sign($data, $partnerSecret);
        $data['amount'] = $dvalue;
        // Log::debug("Tsr dump data.." . print_r($data, true));
        $url = config('tsr.uri');
        $response = CurlHelper::factory($url)
        ->setPostFields($data)
        ->setHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded'
        ])
        ->exec();
        if ($response['status'] != 200)
            throw new Exception("Tsr request to service return error status:" . print_r($response, true));
        //Log::debug("Tsr dump response:" . $response['content']);
        return $response['content'];
    }
}