<?php

namespace OmegaGate;

use Illuminate\Database\Eloquent\Model;

class Attack extends Model
{
    protected $fillable = [
		'source_id',
		'target_id',
		'ticks_remaining',
		'home_ticks_remaining',
		'returning',
		'cancelled',
	];

    public function source() {
    	return $this->belongsTo('OmegaGate\User');
    }

    public function target() {
    	return $this->belongsTo('OmegaGate\User');
    }

    public function ships() {
    	return $this->hasMany('OmegaGate\AttackShip');
    }

    public function isReturning() {
        return $this->returning || $this->cancelled;
    }

}
