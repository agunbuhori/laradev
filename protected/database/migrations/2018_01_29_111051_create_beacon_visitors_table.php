<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeaconVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beacon_visitors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('beacon_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('beacon_id')->references('id')->on('beacons');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beacon_visitors');
    }
}
