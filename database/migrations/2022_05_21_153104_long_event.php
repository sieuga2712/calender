<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LongEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('long_Events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->string('nameEvent');
            $table->String('TypeEvent');
            $table->longText('ListEvent')->nullable();
            $table->rememberToken();
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
        //
         //
         Schema::dropIfExists('long_Events');
    }
}
