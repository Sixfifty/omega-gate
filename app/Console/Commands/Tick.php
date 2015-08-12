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
        echo "User ticks:\n";
        foreach($users as $user) {
            echo "\t{$user->id}: {$user->username}\n";
            $user->deliverAsteroids();
            $user->deliverPowerCells();
            $user->deliverShips();
            $user->tickResources();
            $user->save();
        }

        //Tick down the researching
        \OmegaGate\UserResearch::TickResearching();

        //Do all the attack ticks
        echo "Attack ticks:\n";

        //We are going to load the attacks table, and preload the related tables
        $attacks = \OmegaGate\Attack::with(['ships', 'source', 'target'])->get();

        //For testing, I'm adding faker for coin flipping .etc
        $faker = \Faker\Factory::create();
        foreach ($attacks as $attack) {



            //If they have home ticks remaining and are on their way back, subtract 1.
            if($attack->home_ticks_remaining && ($attack->isReturning())) {
                $attack->home_ticks_remaining--;

                //If no more ticks now, then reintegrate fleet
                if(!$attack->home_ticks_remaining) {
                    
                    
                    //TODO: Reintegrate the fleet brah!
                    $attackShips = $attack->ships;
                    
                    foreach ($attackShips as $attackShip) {
                        //Find the user ship
                        $user = $attack->source;
                        $userShip = $user->user_ships()->where('ship_id', $attackShip->ship_id)->first();
                        
                        //Potential for ship leaking here if the user_ships entry gets deleted.
                        //Should always be one even if the quantity is 0.
                        if($userShip) {
                            $userShip->quantity += $attackShip->quantity;
                            $userShip->save();
                        }
                        //Delete the attack ship, not needed anymore
                        $attackShip->delete();
                        
                    }
                    
                    //TODO: Delete the attack once reintegrated
                    $attack->delete();
                    echo "\t{$attack->id}: arrived home\n";
                    continue;
                } else {
                    $action = 'moved closer to home';
                }

                //Save and hit the next action
                $attack->save();
                echo "\t{$attack->id}: $action\n";
                continue;
                
            }

            //Still here? Lets move the attack closer
            //If they have ticks remaining
            if($attack->ticks_remaining && (!$attack->isReturning())) {


                //Reduce the attack ticks and increase the return ticks
                $attack->ticks_remaining--;
                $attack->home_ticks_remaining++;

                //If no more ticks now, then we attack!
                if(!$attack->ticks_remaining) {


                    $defender = $attack->target;
                    $attacker = $attack->source;

                    //Load the defender's ships
                    $defenderShips = $defender->user_ships()->get();
                    $attackShips = $attack->ships;

                    //---------- FAKE ATTACK LOGIC, REPLACE THIS --------------

                    //I'm just going to randomly flip a coin for each of the attack ships
                    foreach($attackShips as $ship) {

                        //50/50 flip
                        if($faker->boolean) {
                            //this lot dies... mwahahahahahahahaaa
                            $ship->delete();
                        } else {

                            //Do they take damage?
                            if($faker->boolean) {
                                $ship->quantity = $faker->numberBetween(1, $ship->quantity);
                                $ship->save();
                            }
                        }


                    }

                    //Lets do the same with the defender ships
                    foreach($defenderShips as $ship) {

                        //If they have any ships of this kind...
                        if($ship->quantity) {

                            //50/50 flip
                            if($faker->boolean) {
                                //Destroying the whole ship is unfair...
                                //so I'll just take a random number between.
                                $ship->quantity = $faker->numberBetween(0, $ship->quantity);
                                $ship->save();
                            }
                        }
                    }

        

                    //---------- END FAKE ATTACK LOGIC ------------------
                    
                    
                    if($attack->ships()->count()) {
                        $attack->returning = true;
                        $action = 'successfully attacks';    
                    } else {
                        //delete the attack...
                        $attack->delete();
                        echo "\t{$attack->id}: Destroyed\n";
                        continue;
                    }
                    
                } else {
                    $action = 'moved closer to target';
                }
            }

            //Save and hit the next action
            $attack->save();
            echo "\t{$attack->id}: $action\n";
            continue;

            
        }
    }
}
