<?php

namespace OmegaGate\Http\Controllers;

use Illuminate\Http\Request;

use OmegaGate\Http\Requests;
use OmegaGate\Http\Controllers\Controller;
use OmegaGate\Research;
use OmegaGate\Ship;
use OmegaGate\User;
use OmegaGate\Attack;
use OmegaGate\AttackShip;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function whoAmI()
    {

        $user = false;

        if(\Auth::check()) {
            $user = \Auth::user();
        }

        return $this->respond([
            'user' => $user,
            'planets' => User::AllPlanets(),
        ]);
        
    }

    public function allPlanets() {
        return $this->respond([
            'planets' => User::AllPlanets(),
        ]);
    }

    public function placeResourceOrder() {
        $input = \Input::only(['asteroids','powercells']);
        extract($input);
        $user = \Auth::user();

        $user->orderAsteroids($asteroids);
        $user->orderPowerCells($powercells);

        $user->save();

        return $this->respond([
            'user' => $user,
        ]);

    }


    public function placeArmyOrder() {
        $orders = json_decode(\Input::get('orders'));
        
        $user = \Auth::user();

        foreach($orders as $order) {
            $ship = Ship::find($order->ship_id);
            if($ship) {
                $user->orderShips($ship, $order->quantity);
            }
            
        }

        return $this->respond([
            'user' => $user,
        ]);

    }

    public function beginResearch() {
        $researchId = \Input::get('researchId');
        $research = Research::findOrFail($researchId);

        $user = \Auth::user();
        
        if(!$user->canResearch($research)) {
            return $this->respondBadRequest('Cannot research this item');
        }

        $userResearch = $user->beginResearch($research);
        $user->save();

        return $this->respond([
            'user' => $user,
            'user_research' => $userResearch,
            'research' => $research,
        ]);
        


    }

    public function requestScan() {
        $output = [];
        $user = \Auth::user();
        $targetId = \Input::get('target_id');
        $targetUser = User::find($targetId);
        $targetArmy = $targetUser->user_ships;

        $upgradedScan = $user->hasResearched(11);
        $stealthScan = $user->hasResearched(12);
        $fullScan = $user->hasResearched(13);

        foreach($targetArmy as $targetShip) {
            if($targetShip->quantity > 0) {
                $shipInfo = Ship::find($targetShip->ship_id);

                //Prevent including stealth ships if this hasn't been researched!
                if ($shipInfo->stealth) {
                    if($stealthScan) {
                        $quantity = ($fullScan) ? $targetShip->quantity : $this->roughScanResult($targetShip->quantity);
                        $ship = [
                            'name' => $shipInfo->name,
                            'quantity' => $quantity
                        ];
                        $output[] = $ship;
                    }
                } else {
                    $quantity = ($upgradedScan) ? $targetShip->quantity : $this->roughScanResult($targetShip->quantity);
                    $ship = [
                        'name' => $shipInfo->name,
                        'quantity' => $quantity
                    ];
                    $output[] = $ship;
                } 
            }
        }

        return $this->respond([
            'targetName' => $targetUser->planet_name,
            'targetArmy' => $output
        ]);
    }

    public function roughScanResult($exactNumber) {
        $roundToHundred = round($exactNumber, -2);

        if ($roundToHundred > 0) {
            $result = "Around ".$roundToHundred." units.";
        } else {
            $result = "Between 0 and 100 units.";
        }

        return $result;
    }

    public function formAttack() {
        $user = \Auth::user();

        $attackInput = json_decode(\Input::get('attack'));

        
        // --- should be formed like this ---
        // {
        //     target_id: 2,
        //     ships: [
        //        {
        //             ship_id: 4,
        //             quantity: 3
        //        }
        //     ]
        // }
        // 
         
        // Make a local cache of user ships and ships
        $ships = [];
        $userShips = [];


        //Before we do any of the below, I need to check that
        
        // 1. Verify the user being attacked, can be attacked
        $target = User::find($attackInput->target_id);
        if(!$target) return $this->respondBadRequest('The target is invalid');

        
        foreach($attackInput->ships as $newAttackShip) {

            // 2. We need to check that the ships really exist
            $ship = Ship::find($newAttackShip->ship_id);
            if(!$ship) return $this->respondBadRequest('The ship #' . $newAttackShip->ship_id . ' is invalid.');

            // Cache this for later
            $ships[$ship->id] = $ship;

            // 3. The user has the ship type
            $userShip = $user->user_ships()->where('ship_id', $newAttackShip->ship_id)->first();
            if(!$userShip) return $this->respondBadRequest('The user does not have ship #' . $newAttackShip->ship_id);

            // 4. The user has the ships to cover the order
            $userShip = $user->user_ships()->where('ship_id', $newAttackShip->ship_id)->first();
            if($userShip->quantity < $newAttackShip->quantity) return $this->respondBadRequest('The user does not have enough of ship #' . $newAttackShip->ship_id);          

            // Store it in the array, save us looking for it later
            $userShips[$ship->id] = $userShip;

        }
        

        //Still here? Lets concoct the fleet.        
        $attack = new Attack();
        $attack->source_id = $user->id;
        $attack->target_id = $attackInput->target_id;
        $attack->ticks_remaining = 1;
        $attack->save();

        $attackShips = [];

        //Loop through all the ships
        foreach($attackInput->ships as $newAttackShip) {

            //Get the ship type and user ship
            $ship = $ships[$newAttackShip->ship_id];
            $userShip = $userShips[$newAttackShip->ship_id];

            //No ship? Skip this one
            if(!$ship) continue;

            //If we have a slower ship, then we need to make that the ticks
            if($ship->speed > $attack->ticks_remaining) $attack->ticks_remaining = $ship->speed;

            //Subtract the quantity from the user_ships table and save
            $userShip->quantity -= $newAttackShip->quantity;
            $userShip->save();

            //Create the attack ship (super slim chance of ship loss)
            $attackShip = new AttackShip();
            $attackShip->ship_id = $ship->id;
            $attackShip->attack_id = $attack->id;
            $attackShip->quantity = $newAttackShip->quantity;
            $attackShip->save();

            $attackShips[] = $attackShip;

        }

        //Subtract ticks from research
        if($user->hasResearched(24)) $attack->ticks_remaining--;
        if($user->hasResearched(26)) $attack->ticks_remaining--;

        //Set a sensible minimum for attack ticks
        if ($attack->ticks_remaining < 2) $attack->ticks_remaining = 2;

        //Finally, save the attack... again
        $attack->save();

        return $this->respond([
            'user' => $user,
            'attack' => $attack,
            'attackShips' => $attackShips,
        ]);


    }


}
