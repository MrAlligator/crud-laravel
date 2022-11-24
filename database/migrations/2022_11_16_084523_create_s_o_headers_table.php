<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_o_headers', function (Blueprint $table) {
            $table->id('soid');
            $table->date('tanggal');
            $table->string('sonumber', 25);
            $table->integer('accountid');
            $table->string('accountname', 45)->nullable();
            $table->string('customer', 200)->nullable();
            $table->boolean('isConfirmed');
            $table->boolean('isSended');
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
        Schema::dropIfExists('s_o_headers');
    }
};
