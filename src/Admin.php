<?php

namespace Hanoivip\PaymentMethodTsr;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class Admin extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function index(Request $request)
    {
        $serial = $request->input('serial');
        $records = TsrTransaction::orderBy('id', 'desc');
        if (!empty($serial))
        {
            $records = $records->where('serial', $serial);
        }
        $records = $records->paginate(50);
        return view('hanoivip.tsr::admin.tsr', ['records' => $records]);
    }
}