<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParkingLotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parking_lots', function (Blueprint $table) {
            $table->increments('id');
            $table->string('floor');
            $table->string('block');
            $table->bigInteger('price')->default(1000);
            $table->boolean('status')->default(0);
            $table->integer('mall_id')->unsigned();
            $table->timestamps();

            $table->foreign('mall_id')->references('id')->on('malls');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parking_lots');
    }
}
