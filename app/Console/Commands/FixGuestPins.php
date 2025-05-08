<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Guest;
use App\Models\Game;
use Illuminate\Support\Facades\Log;

class FixGuestPins extends Command
{
    protected $signature = 'guests:fix-pins';
    protected $description = 'Fix guest PINs to use game PINs instead of game IDs';

    public function handle()
    {
        $guests = Guest::all();
        $fixed = 0;

        foreach ($guests as $guest) {
            $game = Game::find($guest->pin);
            if ($game) {
                $oldPin = $guest->pin;
                $guest->pin = $game->pin;
                $guest->save();
                $fixed++;
                
                $this->info("Fixed guest {$guest->id} ({$guest->name}): {$oldPin} -> {$guest->pin}");
                Log::info('Fixed guest PIN', [
                    'guest_id' => $guest->id,
                    'guest_name' => $guest->name,
                    'old_pin' => $oldPin,
                    'new_pin' => $guest->pin
                ]);
            }
        }

        $this->info("Fixed {$fixed} guest PINs");
    }
} 