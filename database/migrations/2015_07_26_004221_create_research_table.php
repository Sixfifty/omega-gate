<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use OmegaGate\Research;

class CreateResearchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->string('name');
            $table->text('description');
            $table->integer('metal_cost');
            $table->integer('energy_cost');
            $table->integer('time_cost');
            $table->integer('prerequisite_1_id')->references('id')->on('research')->nullable();
            $table->integer('prerequisite_2_id')->references('id')->on('research')->nullable();
            $table->integer('prerequisite_3_id')->references('id')->on('research')->nullable();
            $table->timestamps();
        });

        $entries = [
            [
            'id' => 1,
            'name' => 'Solar Power Station',
            'description' => 'Allows the creation of Power Cells which produce Energy.',
            'metal_cost' => 1000,
            'energy_cost' => 0,
            'time_cost' => 4
            ],
            [
            'id' => 2,
            'name' => 'Improved Mining',
            'description' => 'Increases metal gained by x1.5.',
            'metal_cost' => 4000,
            'energy_cost' => 0,
            'time_cost' => 4,
            'prerequisite_1_id' => 1,
            // 'prerequisite_2_id',
            // 'prerequisite_3_id',
            ],
            [
            'id' => 3,
            'name' => 'Improved Solar Panels',
            'description' => 'Increases energy gained by x1.5.',
            'metal_cost' => 4000,
            'energy_cost' => 200,
            'time_cost' => 8,
            'prerequisite_1_id' => 2,
            // 'prerequisite_2_id',
            // 'prerequisite_3_id',
            ],
            [
            'id' => 4,
            'name' => 'Trade Channels',
            'description' => 'Allows resource trading with others pocessing this research.',
            'metal_cost' => 4000,
            'energy_cost' => 200,
            'time_cost' => 8,
            'prerequisite_1_id' => 2,
            // 'prerequisite_2_id',
            // 'prerequisite_3_id',
            ],
            [
            'id' => 5,
            'name' => 'Asteroid Scanning',
            'description' => 'Halves the cost of acquiring new Asteroids.',
            'metal_cost' => 4000,
            'energy_cost' => 200,
            'time_cost' => 8,
            'prerequisite_1_id' => 2,
            // 'prerequisite_2_id',
            // 'prerequisite_3_id',
            ],
            [
            'id' => 6,
            'name' => 'Power Cell Factory',
            'description' => 'Halves the cost of acquiring new Power Cells.',
            'metal_cost' => 6000,
            'energy_cost' => 1600,
            'time_cost' => 12,
            'prerequisite_1_id' => 3,
            // 'prerequisite_2_id',
            // 'prerequisite_3_id',
            ],
            [
            'id' => 7,
            'name' => 'Improved Solar Panels 2',
            'description' => 'Increases energy gained by x2.',
            'metal_cost' => 6000,
            'energy_cost' => 1600,
            'time_cost' => 12,
            'prerequisite_1_id' => 3,
            // 'prerequisite_2_id',
            // 'prerequisite_3_id',
            ],
            [
            'id' => 8,
            'name' => 'Improved Mining 2',
            'description' => 'Increases metal gained by x2.',
            'metal_cost' => 6000,
            'energy_cost' => 1600,
            'time_cost' => 12,
            'prerequisite_1_id' => 5,
            // 'prerequisite_2_id',
            // 'prerequisite_3_id',
            ],
            [
            'id' => 9,
            'name' => 'Salvage',
            'description' => 'Recovers a portion of resources from your destroyed ships.',
            'metal_cost' => 32000,
            'energy_cost' => 20000,
            'time_cost' => 36,
            'prerequisite_1_id' => 7,
            'prerequisite_2_id' => 8,
            // 'prerequisite_3_id',
            ],
            [
            'id' => 10,
            'name' => 'Scanning',
            'description' => 'Enables Scans. Rough estimates of enemy army size.',
            'metal_cost' => 4000,
            'energy_cost' => 0,
            'time_cost' => 4,
            'prerequisite_1_id' => 1,
            //'prerequisite_2_id',
            // 'prerequisite_3_id',
            ],
            [
            'id' => 11,
            'name' => 'Upgraded Scanning',
            'description' => 'Accurate reports of enemy army size.',
            'metal_cost' => 4000,
            'energy_cost' => 200,
            'time_cost' => 8,
            'prerequisite_1_id' => 10,
            //'prerequisite_2_id',
            // 'prerequisite_3_id',
            ],
            [
            'id' => 12,
            'name' => 'Stealth Scanning',
            'description' => 'Reports include rough estimates of stealthed enemy ships.',
            'metal_cost' => 15000,
            'energy_cost' => 5000,
            'time_cost' => 24,
            'prerequisite_1_id' => 11,
            //'prerequisite_2_id',
            // 'prerequisite_3_id',
            ],
            [
            'id' => 13,
            'name' => 'Full Scan',
            'description' => 'Accurate reports of all enemy ships.',
            'metal_cost' => 32000,
            'energy_cost' => 20000,
            'time_cost' => 36,
            'prerequisite_1_id' => 12,
            //'prerequisite_2_id',
            // 'prerequisite_3_id',
            ],
            [
            'id' => 14,
            'name' => 'Warp Travel',
            'description' => 'Allows ships to attack enemy planets.',
            'metal_cost' => 4000,
            'energy_cost' => 0,
            'time_cost' => 4,
            'prerequisite_1_id' => 1,
            //'prerequisite_2_id',
            // 'prerequisite_3_id',
            ],
            [
            'id' => 15,
            'name' => 'Unit: Shiva',
            'description' => 'Unlocks medium class ships.',
            'metal_cost' => 4000,
            'energy_cost' => 200,
            'time_cost' => 8,
            'prerequisite_1_id' => 14,
            //'prerequisite_2_id',
            // 'prerequisite_3_id',
            ],
            [
            'id' => 16,
            'name' => 'Cheaper Ships',
            'description' => 'Reduces cost of ships by x1.1.',
            'metal_cost' => 4000,
            'energy_cost' => 200,
            'time_cost' => 8,
            'prerequisite_1_id' => 14,
            //'prerequisite_2_id',
            // 'prerequisite_3_id',
            ],
            [
            'id' => 17,
            'name' => 'Unit: Odin',
            'description' => 'Unlocks glass cannon class ships.',
            'metal_cost' => 15000,
            'energy_cost' => 5000,
            'time_cost' => 12,
            'prerequisite_1_id' => 15,
            //'prerequisite_2_id',
            // 'prerequisite_3_id',
            ],
            [
            'id' => 18,
            'name' => 'Unit: Leviathan',
            'description' => 'Unlocks stealth class ships.',
            'metal_cost' => 15000,
            'energy_cost' => 5000,
            'time_cost' => 24,
            'prerequisite_1_id' => 15,
            //'prerequisite_2_id',
            // 'prerequisite_3_id',
            ],
            [
            'id' => 19,
            'name' => 'Unit: Ifrit',
            'description' => 'Unlocks large class ships.',
            'metal_cost' => 15000,
            'energy_cost' => 5000,
            'time_cost' => 24,
            'prerequisite_1_id' => 15,
            //'prerequisite_2_id',
            // 'prerequisite_3_id',
            ],
            [
            'id' => 20,
            'name' => 'Unit: Bahamut',
            'description' => 'Unlocks large stealth class ships.',
            'metal_cost' => 32000,
            'energy_cost' => 20000,
            'time_cost' => 36,
            'prerequisite_1_id' => 18,
            'prerequisite_2_id' => 19,
            // 'prerequisite_3_id',
            ],
            [
            'id' => 21,
            'name' => 'Armoury',
            'description' => 'Allows research of offensive and defensive upgrades.',
            'metal_cost' => 4000,
            'energy_cost' => 0,
            'time_cost' => 4,
            'prerequisite_1_id' => 1,
            //'prerequisite_2_id',
            // 'prerequisite_3_id',
            ],
            [
            'id' => 22,
            'name' => 'Improved Weapons',
            'description' => 'Increases ship weapon damage by +1.',
            'metal_cost' => 4000,
            'energy_cost' => 200,
            'time_cost' => 8,
            'prerequisite_1_id' => 21,
            //'prerequisite_2_id',
            // 'prerequisite_3_id',
            ],
            [
            'id' => 23,
            'name' => 'Improved Shields',
            'description' => 'Increases ship armour by +2.',
            'metal_cost' => 4000,
            'energy_cost' => 200,
            'time_cost' => 8,
            'prerequisite_1_id' => 21,
            //'prerequisite_2_id',
            // 'prerequisite_3_id',
            ],
            [
            'id' => 24,
            'name' => 'Improved Engines',
            'description' => 'Increases ship speed by +1.',
            'metal_cost' => 4000,
            'energy_cost' => 200,
            'time_cost' => 8,
            'prerequisite_1_id' => 21,
            //'prerequisite_2_id',
            // 'prerequisite_3_id',
            ],
            [
            'id' => 25,
            'name' => 'Improved Shields 2',
            'description' => 'Increases ship armour by +2.',
            'metal_cost' => 6000,
            'energy_cost' => 1600,
            'time_cost' => 12,
            'prerequisite_1_id' => 23,
            //'prerequisite_2_id',
            // 'prerequisite_3_id',
            ],
            [
            'id' => 26,
            'name' => 'Improved Engines 2',
            'description' => 'Increases ship speed by +1.',
            'metal_cost' => 6000,
            'energy_cost' => 1600,
            'time_cost' => 12,
            'prerequisite_1_id' => 24,
            //'prerequisite_2_id',
            // 'prerequisite_3_id',
            ],
            [
            'id' => 27,
            'name' => 'Improved Weapons 2',
            'description' => 'Increases ship weapon damage by +1.',
            'metal_cost' => 15000,
            'energy_cost' => 5000,
            'time_cost' => 24,
            'prerequisite_1_id' => 22,
            //'prerequisite_2_id',
            // 'prerequisite_3_id',
            ],
            [
            'id' => 28,
            'name' => 'Unit: Ragnarok',
            'description' => 'Unlocks battle cruiser class ships.',
            'metal_cost' => 32000,
            'energy_cost' => 20000,
            'time_cost' => 36,
            'prerequisite_1_id' => 25,
            'prerequisite_2_id' => 26,
            'prerequisite_3_id' => 27
            ],
        ];

        foreach($entries as $entry) {
            echo $entry['id'];
            Research::create($entry);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('research');
    }
}
