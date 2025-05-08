<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'color',
        'teamgids',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function guests()
    {
        return $this->hasMany(Guest::class);
    }

    public function teamGids()
    {
        return $this->belongsTo(Guest::class);
    }
}
