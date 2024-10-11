<?php

namespace Hanoivip\PaymentMethodTsr;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Hanoivip\Payment\Models\Transaction;
use Hanoivip\Shop\Facades\OrderFacade;

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
    
    public function openOrder(Request $request)
    {
        $receipt = $request->input('receipt'); // skip: mapping => receipt
        if (!empty($receipt))
        {
            $record = Transaction::where('trans_id', $receipt)->first();
            if (!empty($record)) {
                $orderDetail = OrderFacade::detail($record->order);
                return response()->redirectToRoute('ecmin.shopv2.order', ['tid' => $orderDetail->user_id, 'order' => $record->order]);
            }
        }
        return view('hanoivip.tsr::admin.result', ['error_message' => 'Receipt or Order not found']);
    }
}