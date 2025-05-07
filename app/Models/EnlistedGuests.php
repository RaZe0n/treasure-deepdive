<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EnlistedGuests extends Model
{
    /** @use HasFactory<\Database\Factories\EnlistedGuestsFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'class_name',
        'game_id',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
