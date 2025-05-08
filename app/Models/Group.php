<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'game_id',
        'color',
        'name'
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function guests()
    {
        return $this->hasMany(Guest::class);
    }
} 