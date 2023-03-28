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
        $exists = TsrTransaction::where('trans', $trans->trans_id)->get();
        if ($exists->isNotEmpty())
            throw new Exception('TsrMethod transaction already exists');
        // need to generate mapping to hide transaction
        $log = new TsrTransaction();
        $log->trans = $trans->trans_id;
        $log->mapping = $trans->trans_id;
        $log->save();
        return new TsrSession($trans);
    }

    public function request($trans, $params)
    {
        if (!isset($params['cardpass']) ||
            !isset($params['cardseri']) ||
            !isset($params['cardtype']) ||
            !isset($params['dvalue']))
        {
            return new TsrFailure($trans, __('hanoivip.tsr::tsr.failure.missing-params'));
        }
        $serial = $params['cardseri'];
        $password = $params['cardpass'];
        $cardtype = $params['cardtype'];
        $dvalue = $params['dvalue'];
        //Log::debug(print_r($trans->trans_id, true));
        // save transaction
        $log = TsrTransaction::where('trans', $trans->trans_id)->first();
        if (empty($log))
        {
            return new TsrFailure($trans, __('hanoivip.tsr::tsr.failure.invalid-trans'));
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
            $log->result = json_encode(['status' => 999]);
            $log->save();
            Log::error('TsrMethod exception : ' . $ex->getMessage());
            return new TsrFailure($trans, __('hanoivip.tsr::tsr.failure.exception'));
        }
       
    }

    public function query($trans, $force = false)
    {
        $log = TsrTransaction::where('trans', $trans->trans_id)->first();
        if (empty($log) || empty($log->result))
        {
            return new TsrFailure($trans, __('hanoivip.tsr::tsr.failure.invalid-trans2'));
        }
        $result = new TsrResult($log);
        if ($result->isPending() || $force)
        {
            $cb = TsrCallback::where('mapping', $log->mapping)->first();
            if (empty($cb))
            {
                // had not received any cb, let actively check
                $resp = $this->helper->check(
                    $this->config['partner_id'],
                    $this->config['partner_secret'],
                    $log->serial, $log->password, 
                    $log->cardtype, $log->dvalue, $log->mapping);//dm may thang ho tro con deo biet dieu nay; dat sai thi loi CARD_NOT_EXISTS
                $log->result = $resp;
                $newResult = new TsrResult($log);
                $log->value = $newResult->getAmount();
                $log->save();
                return $newResult;
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