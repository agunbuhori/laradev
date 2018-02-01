<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeaconsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beacons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid')->unique();
            $table->binary('picture')->nullable();
            $table->string('name')->nullable();
            $table->string('color')->nullable();
            $table->string('geo_location')->nullable();
            $table->string('indoor_location')->nullable();
            $table->text('proxymity_message')->nullable();
            $table->text('tags')->nullable();
            $table->smallInteger('major')->nullable();
            $table->smallInteger('minor')->nullable();
            $table->text('description')->nullable();
            $table->string('location_vertical')->nullable();
            $table->string('location_horizontal')->nullable();
            $table->integer('merchant_id')->unsigned()->nullable();
            $table->integer('mall_id')->unsigned()->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('merchant_id')->references('id')->on('merchants');
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
        Schema::dropIfExists('beacons');
    }
}
