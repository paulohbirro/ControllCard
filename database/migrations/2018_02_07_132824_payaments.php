<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Payaments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payaments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome')->nullable();
            $table->string('tipo');
            $table->float('valor', 11, 2);
            $table->float('valorvenda', 11, 2);
            $table->integer('parcelas')->nullable();
            $table->string('ref')->nullable();
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
        Schema::dropIfExists('payaments');
    }
}
