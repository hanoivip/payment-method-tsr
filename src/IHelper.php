<?php

namespace Hanoivip\PaymentMethodTsr;


interface IHelper 
{
    public function charge($partnerId, $partnerSecret, 
        $serial, $password, $telco, $dvalue, $mapping);
    
    public function check($partnerId, $partnerSecret,
        $serial, $password, $telco, $dvalue, $mapping);
}