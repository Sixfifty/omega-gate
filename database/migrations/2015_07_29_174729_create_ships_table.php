<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use OmegaGate\Ship;

class CreateShipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ships', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('hp');
            $table->integer('attack');
            $table->integer('speed');
            $table->integer('metal_cost');
            $table->integer('energy_cost');
            $table->integer('prerequisite_id')->references('id')->on('research')->nullable();
            $table->timestamps();
        });

        $entries = [
            [
            'name' => 'Potato',
            'hp' => 1,
            'attack' => 1,
            'speed' => 9001,
            'metal_cost' => 0,
            'energy_cost' => 1,
            //'prerequisite_id' => 1
            ],
        ];

        foreach($entries as $entry) {
            Ship::create($entry);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ships');
    }
}
