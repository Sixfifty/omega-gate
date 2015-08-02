<?php

namespace OmegaGate;

use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    

	protected $fillable = [
		'name',
		'hp',
		'attack',
		'speed',
		'metal_cost',
		'energy_cost',
		'stealth',
		'prerequisite_id',
	];

}
