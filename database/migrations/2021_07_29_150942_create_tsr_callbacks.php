<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTsrCallbacks extends Migration
{
    public function up()
    {
        Schema::create('tsr_callbacks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mapping');
            $table->integer('value');
            $table->integer('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tsr_callbacks');
    }
}
