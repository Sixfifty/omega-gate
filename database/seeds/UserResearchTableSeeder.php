<?php

use Illuminate\Database\Seeder;

use OmegaGate\User;
use OmegaGate\UserResearch;
use OmegaGate\Research;
use Faker\Factory;

class UserResearchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userIds = User::lists('id');
        $researchIds = Research::lists('id');

        foreach($userIds as $userId) {
        	$ur = new UserResearch();
        	$ur->research_id = $researchIds[0];
        	$ur->user_id = $userId;
        	$ur->save();
        	echo $ur->id . "\n";
        }
    }
}
