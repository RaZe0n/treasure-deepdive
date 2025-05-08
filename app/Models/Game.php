<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Team;
use App\Models\User;

class Game extends Model
{
    protected $fillable = [
        'name',
        'pin',
        'coach_id',
    ];

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function enlisted_guests()
    {
        return $this->hasMany(EnlistedGuests::class);
    }

    public function coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }
}
