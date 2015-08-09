<?php

namespace OmegaGate\Http\Controllers;

use Illuminate\Http\Request;

use OmegaGate\Http\Requests;
use OmegaGate\Http\Controllers\Controller;
use OmegaGate\Research;
use OmegaGate\Ship;
use OmegaGate\User;

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
            'planets' => User::lists('planet_name','id'),
        ]);
        
    }

    public function allPlanets() {
        return $this->respond([
            'planets' => User::lists('planet_name','id'),
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


}
