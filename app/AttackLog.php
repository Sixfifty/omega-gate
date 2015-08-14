<?php

namespace OmegaGate;

use Illuminate\Database\Eloquent\Model;

class AttackLog extends Model
{
    protected $fillable = [
    	'target_id',
    	'source_id'
    ];

    /**
     * Create an attack log from an attack
     * 
     * @param  Attack $attack
     * @return AttackLog
     */
    public static function createFromAttack(Attack $attack) {
    	return self::create([
    			'source_id' => $attack->source_id,
    			'target_id' => $attack->target_id,
    		]);
    }

    /**
     * Return the object as a nice array (awww)
     * 
     * @return array
     */
    public function toArray() {
        return [
            'source_id' => (int) $this->source_id,
            'target_id' => (int) $this->target_id,
            'created_at' => (string) $this->created_at
        ];
    }

    public function source() {
    	return $this->belongsTo('OmegaGate\User');
    }

    public function target() {
    	return $this->belongsTo('OmegaGate\User');
    }
}
