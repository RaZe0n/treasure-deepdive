<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Guest extends Model
{
    /** @use HasFactory<\Database\Factories\GuestFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'pin',
        'group_color',
        'group_name',
        'team_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($guest) {
            Log::info('Saving guest', [
                'guest_id' => $guest->id,
                'attributes' => $guest->getAttributes(),
                'dirty' => $guest->getDirty()
            ]);
        });

        static::saved(function ($guest) {
            Log::info('Guest saved', [
                'guest_id' => $guest->id,
                'attributes' => $guest->getAttributes(),
                'changes' => $guest->getChanges()
            ]);
        });
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
