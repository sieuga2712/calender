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
        Schema::create('Mission_Groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('NameMission');
            $table->string('idgroup');
            $table->integer('limit')->nullable();
            $table->string('StartTime')->nullable();
            $table->string('EndTime')->nullable();
            $table->date('dateMission');
            $table->string('ChainOfId');
            $table->longText('Note')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::table('Mission_Groups', function ($table) {
            $table->string('type');//ckc or ck or Day
            
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
        Schema::dropIfExists('Mission_Groups');
    }
}
