<?php

namespace Hanoivip\PaymentMethodTsr;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Hanoivip\Events\Payment\TransactionUpdated;

class TsrController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function callback(Request $request)
    {
        Log::debug("TsrMethod callback dump:" . print_r($request->all(), true));
        $mapping = $request->get('request_id');
        $value = $request->get('value');
        $status = $request->get('status');
        // save data
        $log = new TsrCallback();
        $log->mapping = $mapping;
        $log->value = $value;
        $log->status = $status;
        $log->save();
        // mapping => trans
        $trans = TsrTransaction::where('mapping', $mapping)->first();
        if (!empty($trans))
        {
            event(new TransactionUpdated($trans->trans));
        }
        // notice payment
        return response(".");
    }
}