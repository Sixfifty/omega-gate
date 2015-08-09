<?php

use Illuminate\Database\Seeder;

use OmegaGate\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'planet_name' => 'Heck',
        	'username' => 'evilthecat',
        	'password' => bcrypt('minor-setback'),
    	]);

        User::create([
            'planet_name' => 'La Planeta De Aqua',
            'username' => 'BobTheKillerGoldfish',
            'password' => bcrypt('darn-soda-pop'),
        ]);
    }
}
