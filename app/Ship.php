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

	public function getUserStats(User $user) {

		$newItem = $this->toArray();

		if ($user->hasResearched(16)) {
            $newItem['metal_cost'] = ($newItem['metal_cost'] * 0.9);
            $newItem['energy_cost'] = ($newItem['energy_cost'] * 0.9);
        }

		if ($user->hasResearched(22)) $newItem['attack']++;
        if ($user->hasResearched(27)) $newItem['attack']++;

        //HP +2 researches
        if ($user->hasResearched(23)) $newItem['hp'] += 2;
        if ($user->hasResearched(25)) $newItem['hp'] += 2;

        //Speed -1 researches
        if ($user->hasResearched(24)) $newItem['speed']--;
        if ($user->hasResearched(26)) $newItem['speed']--;

        return $newItem;
	}

}
