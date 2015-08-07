<?php

namespace OmegaGate;

use Illuminate\Database\Eloquent\Model;

class UserShip extends Model
{
    protected $table = 'user_ships';

    public function deliverShips() {
    	$this->quantity += $this->quantity_pending;
    	$this->quantity_pending = 0;
    }
}
