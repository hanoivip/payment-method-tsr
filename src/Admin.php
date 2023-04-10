<?php

namespace Hanoivip\PaymentMethodTsr;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Admin extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function index(Request $request)
    {
        $page = 0;
        $num = 50;
        if ($request->has('page'))
        {
            $page = $request->input('page');
        }
        $records = TsrTransaction::skip($num * $page)
        ->take($num)->get();
        $total = floor(TsrTransaction::count() / $num);
        Log::debug(TsrTransaction::count());
        return view('hanoivip::admin.tsr', ['records' => $records, 'page' => $page, 'total' => $total]);
    }
}