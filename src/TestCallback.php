<?php

namespace Hanoivip\PaymentMethodTsr;

use Illuminate\Console\Command;
use Hanoivip\Events\Payment\TransactionUpdated;

class TestCallback extends Command
{
    protected $signature = 'test:tsrcallback {requestid} {value} {status}';
    
    protected $description = 'Test of tsr callback';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function handle()
    {
        $mapping = $this->argument('requestid');
        $value = $this->argument('value');
        $status = $this->argument('status');
        // save data
        $log = new TsrCallback();
        $log->mapping = $mapping;
        $log->value = $value;
        $log->status = $status;
        $log->save();
        $trans = TsrTransaction::where('mapping', $mapping)->first();
        if (!empty($trans))
        {
            event(new TransactionUpdated($trans->trans));
            $this->info("done");
        }
    }
}
