<?php

namespace Hanoivip\PaymentMethodTsr;

use Hanoivip\PaymentMethodContract\IPaymentSession;

class TsrSession implements IPaymentSession
{
    private $trans;
    
    public function __construct($trans)
    {
        $this->trans = $trans;
    }
    
    public function getSecureData()
    {}

    public function getGuide()
    {
        return __('hanoivip::tsr.guide');
    }

    public function getData()
    {}
    
    public function getTransId()
    {
        return $this->trans->trans_id;
    }
    
}