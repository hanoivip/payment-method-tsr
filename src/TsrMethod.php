<?php

namespace Hanoivip\PaymentMethodTsr;

use Hanoivip\PaymentMethodContract\IPaymentMethod;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Exception;

class TsrMethod implements IPaymentMethod
{
    private $config;
    
    private $helper;
    
    public function __construct(IHelper $helper)
    {
        $this->helper = $helper;
    }
    
    public function endTrans($trans)
    {}

    public function cancel($trans)
    {}

    public function beginTrans($trans)
    {
        // need to generate mapping to hide transaction
        $log = new TsrTransaction();
        $log->trans = $trans->trans_id;
        $log->mapping = Str::random(8);
        $log->save();
        return new TsrSession($trans);
    }

    public function request($trans, $params)
    {
        $serial = $params['cardpass'];
        $password = $params['cardseri'];
        $cardtype = $params['cardtype'];
        $dvalue = $params['dvalue'];
        //$trans = $params['trans'];
        Log::debug(print_r($trans->trans_id, true));
        // save transaction
        $log = TsrTransaction::where('trans', $trans->trans_id)->first();
        if (empty($log))
        {
            return new TsrFailure($trans, __('hanoivip::tsr.failure.invalid-trans'));
        }
        $log->serial = $serial;
        $log->password = $password;
        $log->cardtype = $cardtype;
        $log->dvalue = $dvalue;
        $mapping = $log->mapping;
        // make request
        try {
            $result = $this->helper->charge(
                $this->config['partner_id'],
                $this->config['partner_secret'],
                $serial, $password, $cardtype, $dvalue, $mapping);
            $log->result = $result;
            $log->save();
            return new TsrResult($log);
        } 
        catch (Exception $ex) 
        {
            $log->save();
            Log::error('TsrMethod exception : ' . $ex->getMessage());
            return new TsrFailure($trans, __('hanoivip::tsr.failure.exception'));
        }
       
    }

    public function query($trans)
    {
        $log = TsrTransaction::where('trans', $trans->trans_id)->first();
        if (empty($log) || empty($log->result))
        {
            return new TsrFailure($trans, __('hanoivip::tsr.failure.invalid-trans2'));
        }
        $result = new TsrResult($log);
        if ($result->isPending())
        {
            $cb = TsrCallback::where('mapping', $log->mapping)->first();
            if (empty($cb))
            {
                // had not received any cb, let actively check
                $newResult = $this->helper->check(
                    $this->config['partner_id'],
                    $this->config['partner_secret'],
                    $log->serial, $log->password, 
                    $log->cardtype, $log->dvalue, $log->mapping);
                $log->result = $newResult;
                $log->save();
                return new TsrResult($log);
            }
            else
            {
                return new TsrResultCallback($trans, $cb);
            }
        }
        return $result;
    }

    public function config($cfg)
    {
        //Log::debug("TsrMethod cfg " . print_r($cfg, true) );
        $this->config = $cfg;
    }    
}