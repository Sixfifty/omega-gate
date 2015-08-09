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

        //$user->save();

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


        //Before we do any of the below, I need to check that
        // 1. The user can use the ships
        // 2. The user has enough ships to cover the order
        // 3. Verify the user being attacked, can be attacked

        $attack = new Attack();
        $attack->source_id = $user->id;
        $attack->target_id = $attackInput->target_id;
        $attack->ticks_remaining = 1;
        $attack->save();

        $attackShips = [];

        //Loop through all the ships
        foreach($attackInput->ships as $newAttackShip) {

            $ship = Ship::find($newAttackShip->ship_id);

            if(!$ship) continue;

            //If we have a slower ship, then we need to make that the ticks
            if($ship->speed > $attack->ticks_remaining) $attack->ticks_remaining = $ship->speed;

            $attackShip = new AttackShip();
            $attackShip->ship_id = $ship->ship_id;
            $attackShip->attack_id = $attack->id;
            $attackShip->quantity = $newAttackShip->quantity;
            $attackShip->save();

            $attackShips[] = $attackShip;

        }

        //Subtract ticks from research
        if($user->hasResesearched(24)) $attack->ticks_remaining--;
        if($user->hasResesearched(26)) $attack->ticks_remaining--;

        //Set a sensible minimum for attack ticks
        if ($attack->ticks_remaining < 2) $attack->ticks_remaining = 2;

        //Finally, save the attack... again
        $attack->save();

        $this->respond([
            'user' => $user,
            'attack' => $attack,
            'attackShips' => $attackShips,
        ]);


    }


}
