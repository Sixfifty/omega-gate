<?php

namespace OmegaGate;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    CONST ASTEROIDCOST = 200;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['planet_name', 'username', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'created_at', 'updated_at'];

    /**
     * Get the current asteroid cost for this user
     */
    public function getAsteroidCostAttribute() {
        
        return self::ASTEROIDCOST * ($this->asteroids + $this->asteroids_pending);
    }

    public function user_research() {
        return $this->hasMany('OmegaGate\UserResearch');
    }

    public function toArray() {
        return [
            'id' => (int) $this->id,
            'username' => $this->username,
            'planet_name' => $this->planet_name,
            'power_cells' => (int) $this->power_cells,
            'power_cells_pending' => (int) $this->power_cells_pending,
            'asteroids' => (int) $this->asteroids,
            'asteroids_pending' => (int) $this->asteroids_pending,
            'asteroid_cost' => (int) $this->asteroid_cost,
            'metal' => (int) $this->metal,
            'energy' => (int) $this->energy,
            'research' => $this->getResearchTreeArray()
        ];
    }

    public function orderAsteroids($asteroidsOrdered) {

        while($asteroidsOrdered > 0) {
            $this->metal -= $this->asteroid_cost;
            $this->asteroids_pending++;
            $asteroidsOrdered--;
        }

        return $this->asteroids_pending;

    }

    /**
     * Convert pending asteroids to real asteroids.
     */
    public function deliverAsteroids() {
        $this->asteroids += $this->asteroids_pending;
        $this->asteroids_pending = 0;

    }

    //Fetch the list of IDs we have researched
    public function getCompletedResearchIds() {
        return $this->user_research()->completed()->lists('research_id');
    }

    //Fetch the list of IDs we have researched
    public function getTickingResearchIds() {
        return $this->user_research()->incomplete()->lists('research_id');
    }

    public function getAvailableResearchIds($completedIds, $tickingIds) {
        return Research::availableToResearch($completedIds, $tickingIds)->lists('id');
    }

    public function getResearchTreeArray() {

        $output = [];

        $completedIds = $this->getCompletedResearchIds()->toArray();
        $tickingIds = $this->getTickingResearchIds()->toArray();
        $canResearch = empty($tickingIds);
        $availableIds = $this->getAvailableResearchIds($completedIds, $tickingIds)->toArray();

        $allResearch = Research::all();

        foreach ($allResearch as $research) {
            $newItem = $research->toArray();

            //Blocked by default
            $state = 4;

            if(in_array($research->id, $completedIds)) {
                $state = 1; //Completed
            } elseif (in_array($research->id, $tickingIds)) {
                $state = 3; //Researching
            
            } elseif ($canResearch && in_array($research->id, $availableIds)) {
                $state = 2; //Available
            }

            //Inject it into our array
            $newItem['state'] = $state;

            $output[] = $newItem;
        }

        return $output;

    }
}
