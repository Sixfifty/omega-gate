<?php

namespace OmegaGate\Http\Controllers;

use Illuminate\Http\Request;

use OmegaGate\Http\Requests;
use OmegaGate\Http\Controllers\Controller;

class UserController extends Controller
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

        return [
            'user' => $user,
        ];
        
    }

    public function placeOrder() {
        $input = \Input::only(['asteroids','powercells']);
        extract($input);
        $user = \Auth::user();

        $user->orderAsteroids($asteroids);
        //$user->orderPowerCells($powercells);

        $user->save();

        return [
            'user' => $user,
        ];

    }


}
