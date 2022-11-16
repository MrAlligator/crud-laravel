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
        Schema::create('s_o_items', function (Blueprint $table) {
            $table->id('noid');
            $table->integer('soid');
            $table->integer('itemid');
            $table->string('itemcode', 25);
            $table->string('itemname', 100);
            $table->string('qty');
            $table->decimal('price', 19,2);
            $table->decimal('discount', 19,2);
            $table->decimal('total', 19,2);
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
        Schema::dropIfExists('s_o_items');
    }
};
