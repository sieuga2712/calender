<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MissionGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('Mission_Group', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('NameMission');
            $table->string('idgroup');
            $table->integer('limit');
            $table->string('StartTime')->nullable();
            $table->string('EndTime')->nullable();
            $table->date('dateMission');
           
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
        Schema::dropIfExists('Mission_Group');
    }
}
