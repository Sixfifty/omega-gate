<?php

namespace OmegaGate;

use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'research';

    protected $fillable = [
        'id',
    	'name',
		'description',
		'metal_cost',
		'energy_cost',
		'time_cost',
		'prerequisite_1_id',
		'prerequisite_2_id',
		'prerequisite_3_id',
    ];

    public function prerequisite_1() {
        return $this->belongsTo('OmegaGate\Research');
    }

    public function prerequisite_2() {
        return $this->belongsTo('OmegaGate\Research');
    }

    public function prerequisite_3() {
        return $this->belongsTo('OmegaGate\Research');
    }

    //Onces with no requirements

    //Ones where the user has met all of the requirements

    

}
