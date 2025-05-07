<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
