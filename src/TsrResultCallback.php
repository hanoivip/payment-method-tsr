<?php

namespace Hanoivip\PaymentMethodTsr;

use Hanoivip\PaymentMethodContract\IPaymentResult;

class TsrResultCallback implements IPaymentResult
{
    private $record;
    
    private $trans;
    
    public function __construct($trans, $record)
    {
        $this->trans = $trans;
        $this->record = $record;    
    }
    
    public function getDetail()
    {
        return __('hanoivip::tsr.messages.' . $this->record->status);
    }

    public function isPending()
    {
        return false;
    }

    public function isFailure()
    {
        return !$this->isSuccess();
    }

    public function isSuccess()
    {
        return $this->record->status == 1 || $this->record->status == 2;
    }

    public function getAmount()
    {
        if ($this->isSuccess())
        {
            return $this->record->value;
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
        return $this->trans;
    }    
}