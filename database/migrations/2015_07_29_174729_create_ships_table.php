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
            $table->integer('stealth');
            $table->integer('prerequisite_id')->references('id')->on('research')->nullable();
            $table->timestamps();
        });

        $entries = [
            [
            'name' => 'Valefor',
            'hp' => 4,
            'attack' => 4,
            'speed' => 4,
            'metal_cost' => 100,
            'energy_cost' => 0,
            'stealth' => 0,
            //'prerequisite_id' => 1
            ],
            [
            'name' => 'Shiva',
            'hp' => 8,
            'attack' => 4,
            'speed' => 5,
            'metal_cost' => 150,
            'energy_cost' => 50,
            'stealth' => 0,
            'prerequisite_id' => 15
            ],
            [
            'name' => 'Ifrit',
            'hp' => 8,
            'attack' => 8,
            'speed' => 6,
            'metal_cost' => 250,
            'energy_cost' => 100,
            'stealth' => 0,
            'prerequisite_id' => 19
            ],
            [
            'name' => 'Odin',
            'hp' => 4,
            'attack' => 8,
            'speed' => 3,
            'metal_cost' => 150,
            'energy_cost' => 500,
            'stealth' => 0,
            'prerequisite_id' => 17
            ],
            [
            'name' => 'Leviathan',
            'hp' => 4,
            'attack' => 4,
            'speed' => 4,
            'metal_cost' => 200,
            'energy_cost' => 400,
            'stealth' => 1,
            'prerequisite_id' => 18
            ],
            [
            'name' => 'Bahamut',
            'hp' => 8,
            'attack' => 4,
            'speed' => 6,
            'metal_cost' => 350,
            'energy_cost' => 600,
            'stealth' => 1,
            'prerequisite_id' => 20
            ],
            [
            'name' => 'Ragnarok',
            'hp' => 40,
            'attack' => 40,
            'speed' => 8,
            'metal_cost' => 900,
            'energy_cost' => 500,
            'stealth' => 0,
            'prerequisite_id' => 28
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
