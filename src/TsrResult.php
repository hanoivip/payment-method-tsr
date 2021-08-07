<?php

namespace Hanoivip\PaymentMethodTsr;

use Hanoivip\PaymentMethodContract\IPaymentResult;

class TsrResult implements IPaymentResult
{
    private $json;
    /**
     * 
     * @var TsrTransaction
     */
    private $trans;
    
    public function __construct($trans)
    {
        $this->trans = $trans;
        $this->json = json_decode($trans->result, true);    
    }
    
    public function getDetail()
    {
        return __('hanoivip::tsr.messages.' . $this->json['status']);
    }

    public function isPending()
    {
        return $this->json['status'] == 99;
    }

    public function isFailure()
    {
        return !$this->isSuccess() && !$this->isPending();
    }

    public function isSuccess()
    {
        return $this->json['status'] == 1 || $this->json['status'] == 2;
    }

    public function getAmount()
    {
        if ($this->isSuccess())
        {
            $value = $this->json['value'];
            if ($value != $this->trans->dvalue)
            {
                $penalty = config('tsr.penalty', 0);
                $value = (100 - $penalty) * $value / 100;
            }
            return $value;
        }
        return 0;
    }
    
    public function toArray()
    {
        $arr = [];
        $arr['detail'] = $this->getDetail();
        $arr['amount'] = $this->getAmount();
        $arr['isPending'] = $this->isPending();
        $arr['isFailure'] = $this->isFailure();
        $arr['isSuccess'] = $this->isSuccess();
        return $arr;
    }

    public function getTransId()
    {
        return $this->trans->trans;
    }


    
}