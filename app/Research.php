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

    public function toArray() {
        return [
            'id' => (int) $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'metal_cost' => (int) $this->metal_cost,
            'energy_cost' => (int) $this->energy_cost,
            'time_cost' => (int) $this->time_cost,
            'prerequisite_1_id' => $this->prerequisite_1_id ? (int) $this->prerequisite_1_id : null,
            'prerequisite_2_id' => $this->prerequisite_2_id ? (int) $this->prerequisite_2_id : null,
            'prerequisite_3_id' => $this->prerequisite_3_id ? (int) $this->prerequisite_3_id : null,
        ];
    }

    public function user_research() {
        return $this->hasMany('OmegaGate\UserResearch');
    }

    public function prerequisite_1() {
        return $this->belongsTo('OmegaGate\Research');
    }

    public function prerequisite_2() {
        return $this->belongsTo('OmegaGate\Research');
    }

    public function prerequisite_3() {
        return $this->belongsTo('OmegaGate\Research');
    }

    public function scopeAvailableToResearch($query, $researchIds, $tickingIds) {
        
        $prerequisite_fields = [
            'prerequisite_1_id',
            'prerequisite_2_id',
            'prerequisite_3_id',
        ];

        //Where prerequisite fields are null or are in our list
        foreach($prerequisite_fields as $field) {
            $query->where(function ($query) use ($field, $researchIds) {
                $query
                    ->whereNull($field)
                    ->orWhereIn($field, $researchIds);
            });
        }

        //Exclude items that have already been researched
        $query->whereNotIn('id', $researchIds);

        //Exclude items that are currently being researched
        $query->whereNotIn('id', $tickingIds);

        return $query;

    }

    //Onces with no requirements

    //Ones where the user has met all of the requirements

    

}
