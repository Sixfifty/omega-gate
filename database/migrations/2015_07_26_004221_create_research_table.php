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
            'name' => 'JIM',
            'description' => 'JIM',
            'metal_cost' => 100,
            'energy_cost' => 0,
            'time_cost' => 2,
            // 'prerequisite_1_id',
            // 'prerequisite_2_id',
            // 'prerequisite_3_id',
            ],
            [
            'id' => 2,
            'name' => 'Peter',
            'description' => 'Puppy',
            'metal_cost' => 100,
            'energy_cost' => 0,
            'time_cost' => 2,
            'prerequisite_1_id' => 1,
            // 'prerequisite_2_id',
            // 'prerequisite_3_id',
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
