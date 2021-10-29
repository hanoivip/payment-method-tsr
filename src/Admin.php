<?php

namespace Hanoivip\PaymentMethodTsr;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Hanoivip\Events\Payment\TransactionUpdated;

class Admin extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    
}