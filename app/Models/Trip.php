<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Trip extends Model
{
    protected $fillable = ['start_location', 'destination', 'departure_time', 'driver_id', 'available_seats'];

    protected $casts = [
        'origin' => 'array',
        'destination' => 'array',
        //'driver_location' => 'array', we will not update driver location each time ,so 'driver_location' = 'origin' 
        'is_complete'=> 'boolean',
        'is_started'=> 'boolean',

    ];

    public function startLocation(): HasOne
    {
        return $this->HasOne(Location::class);
    }

    public function destination(): HasOne
    {
        return $this->HasOne(Location::class);
    }

    public function driver(): HasOne
    {
        return $this->HasOne(User::class);
    }

    public function passengers(): BelongsToMany
    {
        return $this->BelongsToMany(User::class, 'trips_users', 'trip_id', 'user_id');
    }

    use HasFactory;

    //Filter
    public function scopeFilter($query, array $filters) {

        //User clicks on tags to get quick searches
        if($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        //OR Uses the
        //Search bar
        if($filters['search'] ?? false) {
            $query->where('start_location', 'like', '%' . request('search') . '%')
                ->where('destination', 'like', '%' . request('search') . '%')
                ->orWhere('departure_time', 'like', '%' . request('search') . '%')
                ->orWhere('available_seats', 'like', '%' . request('search') . '%');
        }
    }

    //Each Trip has its owner: in our case driver_id or user_id
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
