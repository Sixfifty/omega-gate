<?php

namespace OmegaGate\Http\Controllers;

use Illuminate\Http\Request;

use OmegaGate\Http\Requests;
use OmegaGate\Http\Controllers\Controller;
use OmegaGate\Research;

class ResearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
    	$user = \Auth::user();

    	

        return Research::all();
    }

}
