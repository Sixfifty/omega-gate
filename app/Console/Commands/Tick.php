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

                    //Let's create an attack log (for defense logs .etc)
                    \OmegaGate\AttackLog::createFromAttack($attack);

                    $defender = $attack->target;
                    $attacker = $attack->source;

                    //Load the defender's ships
                    $defenderShips = $defender->user_ships()->get();
                    $attackShips = $attack->ships;


                    //Get the speed array for the defender
                    $finalDefence = [];
                    foreach($defenderShips as $ships) {
                        $ship = $ships->ship;
                        if($ship) {
                            $arrShip = $ship->getUserStats($defender);
                            $arrShip['quantity'] = $ships->quantity;
                            $arrShip['model'] = $ships;
                            if(!array_key_exists($arrShip['speed'], $finalDefence)) $finalDefence[$arrShip['speed']] = [];
                            $finalDefence[$arrShip['speed']][] = $arrShip;
                        }
                    }

                    $finalAttack = [];
                    foreach($attackShips as $ships) {
                        $ship = $ships->ship;
                        if($ship) {
                            $arrShip = $ship->getUserStats($attacker);
                            $arrShip['quantity'] = $ships->quantity;
                            $arrShip['model'] = $ships;
                            if(!array_key_exists($arrShip['speed'], $finalAttack)) $finalAttack[$arrShip['speed']] = [];
                            $finalAttack[$arrShip['speed']][] = $arrShip;
                        }
                    }



                    //Walk through the lists until one of them is empty
                    while(!empty($finalAttack) && !empty($finalDefence)) {

                        //Shift the first ships out of the arrays
                        $firstAttack = array_shift($finalAttack);
                        $firstAttackShip = array_shift($firstAttack);

                        $firstDefence = array_shift($finalDefence);
                        $firstDefenceShip = array_shift($firstDefence);



                        // Work out the attack chance for success in percent
                        if($firstAttackShip['attack'] == $firstDefenceShip['hp']) {
                            $chance = 50;
                        } else if($firstAttackShip['attack'] > $firstDefenceShip['hp']) {
                            $chance = 50 + (($firstAttackShip['attack'] - $firstDefenceShip['hp']) * 5);
                        } else {
                            $chance = 50 - (($firstDefenceShip['hp'] - $firstAttackShip['attack']) * 5);
                        }

                        //We must allow some chance of success
                        if($chance > 95) {
                            $chance = 95;
                        } else if ($chance < 5) {
                            $chance = 5;
                        }

                        //Work out the precentage chance of win
                        /*
                             When attacking something:

                                If attacking ship's att === recieving ship's hp, chance to kill is 50%.
                                
                                For each point of difference between the two, add or subtract 5%.

                                So:

                                Att     HP      Chance to Kill
                                4       4       50%
                                5       4       55%
                                12      4       90%
                                4       12      10%

                                Exception are Ragnaroks with their bloody 40HP/40Att...
                                In this event, cap it at 95% :p

                                if (att === hp) {
                                    chance = 50;
                                } else if (att > hp) {
                                    chance = 50 + ((att - hp)*5);
                                } else {
                                    chance = 50 - ((hp - att)*5);
                                }

                                if (chance > 95) {
                                    chance = 95;
                                }

                                if (chance < 5) {
                                    chance = 5;
                                }

                            */

                        //Put the real single ship vs single ship logic here
                        
                        while($firstAttackShip['quantity'] && $firstDefenceShip['quantity']) {
                            //Do the attack
                            if($faker->boolean($chance)) {
                                echo "$chance - attack wins \n";
                                $firstDefenceShip['quantity']--;
                            } else {
                                echo "$chance - defence wins \n";
                                $firstAttackShip['quantity']--;
                            }
                        }
                        
                       
                        
                        //Put the winner, back in (because they haven't had enough punishment yet)
                        $attackModel = $firstAttackShip['model'];
                        $defenceModel = $firstDefenceShip['model'];
                        if($firstAttackShip['quantity'] > 0) {
                            //Put the ship back in the speed
                            array_unshift($firstAttack, $firstAttackShip);
                            $finalAttack[$firstAttackShip['speed']] = $firstAttack;
                            //Persist quantity to DB
                            $attackModel->quantity = $firstAttackShip['quantity'];
                            $attackModel->save();
                        } else {
                            //Delete if all gone
                            $attackModel->delete();
                        }

                        if($firstDefenceShip['quantity'] > 0) {
                            //Put the ship back in the speed
                            array_unshift($firstDefence, $firstDefenceShip);
                            $finalDefence[$firstDefenceShip['speed']] = $firstDefence;
                            $model = $firstAttackShip['model'];
                        }
                        //Persist quantity to DB
                        $defenceModel->quantity = $firstDefenceShip['quantity'];
                        $defenceModel->save();

                    }

                    //Save ships to the database

                    //Loot.

                    //If attacker had Salvage, 20% of destroyed resources back
                    //If defender has Salvage, 30% of destroyed resources back

                    //If there is an attacking force left
                    //For % of total defender ships destroyed
                    //Take total asteroids/powercells, deduct the safe 5. Give the attacker 10% of both + percentage of ships lost

                    
                    
                    if($attack->ships()->count()) {
                        $attack->returning = true;
                        $action = 'successfully attacks';

                        //Asteroid loot
                        $defender->asteroids = $defender->asteroids > 10 ? $defender->asteroids - 5  : 5;
                        $attacker->asteroids += 5;
                        $defender->save();
                        $attacker->save();

                    } else {
                        //delete the attack...
                        $attack->delete();
                        echo "\t{$attack->id}: Destroyed\n";

                        //Asteroid loot
                        $attacker->asteroids = $attacker->asteroids > 10 ? $attacker->asteroids - 5  : 5;
                        $defender->asteroids += 5;
                        $attacker->save();
                        $defender->save();
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
