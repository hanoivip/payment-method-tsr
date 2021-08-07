<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTsrTransactions extends Migration
{
    function up()
    {
        Schema::create('tsr_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('trans')->comment('Transaction ID = Purchase token');
            $table->string('mapping');
            $table->string('serial')->default('');
            $table->string('password')->default('');
            $table->string('cardtype')->default('');
            $table->integer('dvalue')->default(0);
            $table->integer('value')->default(0)->comment('This is final value');
            $table->string('result')->default('');
            //$table->integer()->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('tsr_transactions');
    }
}
