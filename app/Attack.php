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

    public function toArray() {
        return [
            'id' => (int) $this->id,
            'ticks_remaining' => (int) $this->ticks_remaining,
            'home_ticks_remaining' => (int) $this->home_ticks_remaining,
            'returning' => (bool) $this->returning,
            'cancelled' => (bool) $this->cancelled,
            'source_id' => (int) $this->source_id,
            'target_id' => (int) $this->target_id
        ];
    }

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
