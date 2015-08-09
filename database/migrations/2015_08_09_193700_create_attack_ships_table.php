<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttackShipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attack_ships', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attack_id')->references('id')->on('attack')->nullable();
            $table->integer('ship_id')->references('id')->on('ships')->nullable();
            $table->integer('quantity');
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
        Schema::drop('attack_ships');
    }
}
