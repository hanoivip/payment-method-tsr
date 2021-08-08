<?php

namespace Hanoivip\PaymentMethodTsr;

use Illuminate\Support\Facades\Cache;


class HelperTestDelay implements IHelper
{
    
    public function charge($partnerId, $partnerSecret, 
        $serial, $password, $telco, $dvalue, $mapping)
    {
        $test = array(
            'status' => 99, 'message' => 'The tre');
        return json_encode($test);
    }
    
    public function check($partnerId, $partnerSecret,
        $serial, $password, $telco, $dvalue, $mapping)
    {
        $delay = 0;
        if (Cache::has('TsrHelperTestDelay'))
        {
            $delay = Cache::get('TsrHelperTestDelay');
        }
        if ($delay < 3)
        {
            $test = array(
                'status' => 99, 'message' => 'The tre');
            return json_encode($test);
        }
        else 
            {
            $test = array(
                'status' => 1, 'message' => 'The dung', 'value' => 100000,
                'amount' => 0, 'code' => $password, 'serial' => $serial,
                'request_id' => mt_rand(10000, 50000), 'telco' => $telco);
        }
        return json_encode($test);
    }
    
}