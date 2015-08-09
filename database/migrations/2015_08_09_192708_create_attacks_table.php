<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attacks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('source_id')->references('id')->on('users')->nullable();
            $table->integer('target_id')->references('id')->on('users')->nullable();

            $table->integer('ticks_remaining');
            $table->integer('home_ticks_remaining');
            $table->boolean('returning');
            $table->boolean('cancelled');
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
        Schema::drop('attacks');
    }
}
