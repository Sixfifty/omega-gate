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
    	'name',
		'description',
		'metal_cost',
		'energy_cost',
		'time_cost',
		'prerequisite_1_id',
		'prerequisite_2_id',
		'prerequisite_3_id',
    ];


}
