<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('malls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->binary('picture')->nullable();
            $table->string('name');
            $table->double('latitude')->default(0);
            $table->double('longitude')->default(0);
            $table->text('address')->nullable();
            $table->text('description')->nullable();
            $table->boolean('status')->default(0);
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->integer('mall_id')->unsigned()->nullable();

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
        Schema::dropIfExists('malls');
    }
}
