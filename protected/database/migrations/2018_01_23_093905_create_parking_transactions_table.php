<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParkingTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parking_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parking_lot_id')->unsigned();
            $table->datetime('booked');
            $table->datetime('check_in')->nullable();
            $table->datetime('check_out')->nullable();
            $table->boolean('status')->default(1);
            $table->string('verification')->nullable();
            $table->integer('vehicle_id')->unsigned();

            $table->foreign('parking_lot_id')->references('id')->on('parking_lots');
            $table->foreign('vehicle_id')->references('id')->on('vehicles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parking_transactions');
    }
}
