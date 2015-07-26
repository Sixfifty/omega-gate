<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
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
