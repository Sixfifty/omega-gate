<?php

use Illuminate\Database\Seeder;
use OmegaGate\Research;
use Faker\Factory;

class ResearchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$faker = Faker\Factory::create();

    	foreach(range(1, 20) as $index)
		{
	        Research::create([
		    	'name' => implode(' ', $faker->words(3)),
				'description' => $faker->sentence,
				'metal_cost' => $faker->numberBetween(0,1000),
				'energy_cost' => $faker->numberBetween(0,1000),
				'time_cost' => $faker->numberBetween(1,3),
				// 'prerequisite_1_id',
				// 'prerequisite_2_id',
				// 'prerequisite_3_id',
	    	]);
    	}
    }
}
