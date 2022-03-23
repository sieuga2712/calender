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
        Schema::create('detail_Events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->string('nameEvent');
            $table->string('timeStart')->nullable();
            $table->string('timeEnd')->nullable();
            $table->date('dateOfEvent');
            $table->string('group')->nullable();
            $table->longText('Note')->nullable();
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
        Schema::dropIfExists('detail_Events');
    }
}
