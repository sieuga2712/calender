<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetailEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('detailEvent', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->string('nameEvent');
            $table->string('timeStart');
            $table->string('timeEnd');
            $table->date('dateOfEvent');
            $table->string('group');
            $table->longText('Note');
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
        Schema::dropIfExists('detailEvent');
    }
}
