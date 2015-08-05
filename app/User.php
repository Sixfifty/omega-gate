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

    CONST 
        ASTEROID_COST = 200,
        POWERCELL_COST = 200,
        TICK_ENERGY = 1000,
        TICK_METAL = 1000;


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
     * Bootstrap any model events.
     *
     * @return void
     */
    public static function boot()
    {
        //Start the user with these amounts
        User::creating(function ($user) {
            $user->metal = 1000;
            $user->asteroids = 5;
        });
        parent::boot();
    }

    /**
     * Get the current asteroid cost for this user
     */
    public function getAsteroidCostAttribute() {

        $multiplier = 1;
        if($this->hasResearched(5)) $multiplier = 0.5;
        
        return (self::ASTEROID_COST * ($this->asteroids + $this->asteroids_pending)) * $multiplier;
    }

    /**
     * Get the current power cell cost for this user
     */
    public function getPowerCellCostAttribute() {

        $multiplier = 1;
        if($this->hasResearched(6)) $multiplier = 0.5;

        return (self::POWERCELL_COST * ($this->power_cells + $this->power_cells_pending)) * $multiplier;
        
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
            'power_cell_cost' => (int) $this->power_cell_cost,
            'asteroids' => (int) $this->asteroids,
            'asteroids_pending' => (int) $this->asteroids_pending,
            'asteroid_cost' => (int) $this->asteroid_cost,
            'metal' => (int) $this->metal,
            'energy' => (int) $this->energy,
            'research' => $this->getResearchTreeArray(),
            'ships' => $this->getShipsArray()
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

    public function orderPowerCells($powerCellsOrdered) {

        while($powerCellsOrdered > 0) {
            $this->energy -= $this->power_cell_cost;
            $this->power_cells_pending++;
            $powerCellsOrdered--;
        }

        return $this->power_cells_pending;

    }

    /**
     * Convert pending asteroids to real asteroids.
     */
    public function deliverAsteroids() {
        $this->asteroids += $this->asteroids_pending;
        $this->asteroids_pending = 0;

    }

    /**
     * Convert pending power cells to real power cells.
     */
    public function deliverPowerCells() {
        $this->power_cells += $this->power_cells_pending;
        $this->power_cells_pending = 0;

    }

    public function tickMetal() {
        $multiplier = 1;
        if($this->hasResearched(2)) $multiplier = 1.5;
        if($this->hasResearched(8)) $multiplier = 2;
        $this->metal += (self::TICK_METAL * $multiplier);

    }

    public function tickEnergy() {
        $multiplier = 1;
        if($this->hasResearched(3)) $multiplier = 1.5;
        if($this->hasResearched(7)) $multiplier = 2;

        $this->energy += (self::TICK_ENERGY * $multiplier);
    }

    public function tickResources() {
        $this->tickMetal();
        $this->tickEnergy();
        
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

    public function canResearch(Research $research) {

        //Do they have the resources?
        if(($this->metal < $research->metal_cost) || ($this->energy < $research->energy_cost)) return false;

        $tickingIds = $this->getTickingResearchIds();

        //Researching anything? No you can't research.
        if(!$tickingIds) return false;

        $completedIds = $this->getCompletedResearchIds();

        //Is it in the completed list? Then you can't do it.
        if(in_array($research->id, $completedIds->toArray())) return false;


        //Allright, now we get to the heavy query...
        $availableIds = $this->getAvailableResearchIds($completedIds, $tickingIds);
        
        //Is the ID not in the list of available IDs? You can't research it.
        if(!in_array($research->id, $availableIds->toArray())) return false;

        //Still here? Good.
        return true;


    }

    public function beginResearch(Research $research) {
        $userResearch = new UserResearch();
        $userResearch->ticks_remaining = $research->time_cost;
        $userResearch->research_id = $research->id;
        $userResearch->user_id = $this->id;
        $userResearch->save();

        $this->metal -= $research->metal_cost;
        $this->energy -= $research->energy_cost;

        return $userResearch;
    }

    public function hasResearched($id) {
        //Attempt to pull the item
        if(!$this->user_research->contains('research_id', $id)) return false;

        foreach($this->user_research as $userResearch) {
            if($userResearch->research_id == $id) {
                return ! $userResearch->ticks_remaining;
            }
        }
        
        //Still here?
        return false; //Just in case
        
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

    public function user_ships() {
        return $this->hasMany('OmegaGate\UserShip');
    }

    //Fetch the list of IDs we have researched
    public function getArmy() {
        return $this->user_ships()->lists('quantity', 'ship_id');
    }

    public function getPendingArmy() {
        return $this->user_ships()->lists('quantity_pending', 'ship_id');
    }

    public function getShipsArray() {
        $output = [];

        $userShips = $this->getArmy()->toArray();
        $pendingShips = $this->getPendingArmy()->toArray();

        $allShips = Ship::all();

        foreach ($allShips as $ship) {
            $newItem = $ship->toArray();

            if (array_key_exists($ship->id, $userShips)) {
                $newItem['quantity'] = $userShips[$ship->id];
            } else {
                $newItem['quantity'] = 0;
            }

            if (array_key_exists($ship->id, $pendingShips)) {
                $newItem['quantity_pending'] = $pendingShips[$ship->id];
            } else {
                $newItem['quantity_pending'] = 0;
            }

            $output[] = $newItem;
        }

        return $output;
    }
}
