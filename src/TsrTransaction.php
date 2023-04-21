<?php

namespace Hanoivip\PaymentMethodTsr;

use Illuminate\Database\Eloquent\Model;

class TsrTransaction extends Model
{
    public $timestamps = false;
    
    function transaction() 
    {
        return $this->hasOne('Hanoivip\Payment\Models\Transaction', 'trans_id', 'trans');
    }
    
}
