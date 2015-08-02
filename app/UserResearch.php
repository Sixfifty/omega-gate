<?php

namespace OmegaGate;

use Illuminate\Database\Eloquent\Model;

class UserResearch extends Model
{

	protected $table = 'user_research';

    public static function TickResearching() {
        return self::incomplete()->decrement('ticks_remaining');
    }

    public function research() {
    	return $this->belongsTo('OmegaGate\Research');
    }

    public function user() {
    	return $this->belongsTo('OmegaGate\User');
    }

    public function getCompletedAttribute() {
    	return !$this->ticks_remaining;
    }

    public function scopeCompleted($query) {
    	return $query->where('ticks_remaining', 0);
    }

    public function scopeIncomplete($query) {
    	return $query->where('ticks_remaining', '>', 0);
    }

}
