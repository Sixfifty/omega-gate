<?php

namespace OmegaGate;

use Illuminate\Database\Eloquent\Model;

class AttackShip extends Model
{

	protected $fillable = [
		'attack_id',
		'ship_id',
		'quantity'
	];
    

    public function ship() {
    	return $this->belongs_to('OmegaGate\Ship');
    }

    public function attack() {
    	return $this->belongs_to('OmegaGate\Attack');
    }


}
