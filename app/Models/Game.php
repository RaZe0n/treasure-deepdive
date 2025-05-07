<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Team;

class Game extends Model
{
    protected $fillable = [
        'name',
        'pin',
    ];

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function enlisted_guests()
    {
        return $this->hasMany(EnlistedGuests::class);
    }
}
