<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IrsMessageTranscation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('irs_message_transaction', function (Blueprint $table) {
            $table->index('idtrx');
            $table->bigIncrements('no')->autoIncrement();
            $table->string('idtrx')->primarykey();
            $table->string('tujuan', '20');
            $table->string('kode', '200');

            $table->string('status', '200');

            $table->json('response')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('irs_message_transaction');
    }
}
