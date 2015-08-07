<?php

namespace OmegaGate\Console\Commands;

use Illuminate\Console\Command;

class Tick extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tick:happen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'The Tick, of DOOOM!.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //Tick individual user actions
        $users = \OmegaGate\User::with(['user_research', 'user_ships'])->get();
        foreach($users as $user) {
            echo $user->username . "\n";
            $user->deliverAsteroids();
            $user->deliverPowerCells();
            $user->deliverShips();
            $user->tickResources();
            $user->save();
        }

        //Tick down the researching
        \OmegaGate\UserResearch::TickResearching();
    }
}
