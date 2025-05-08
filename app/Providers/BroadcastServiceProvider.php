<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Broadcasting\BroadcastManager;
use Illuminate\Contracts\Broadcasting\Factory as BroadcastingFactory;
use Illuminate\Contracts\Broadcasting\Broadcaster as BroadcastContract;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(BroadcastManager::class, function ($app) {
            return new BroadcastManager($app);
        });

        $this->app->singleton(BroadcastingFactory::class, function ($app) {
            return $app->make(BroadcastManager::class);
        });

        $this->app->singleton(BroadcastContract::class, function ($app) {
            return $app->make(BroadcastManager::class)->connection();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Broadcast::channel('private-user.{id}', function ($user, $id) {
            try {
                Log::info('Channel authorization attempt', [
                    'user' => $user ? $user->id : 'guest',
                    'requested_id' => $id,
                    'session_guest_id' => Session::get('guest_id'),
                    'session_id' => Session::getId()
                ]);

                // For authenticated users
                if ($user) {
                    return (string) $user->id === (string) $id;
                }
                
                // For guests
                $guestId = Session::get('guest_id');
                return (string) $guestId === (string) $id;

            } catch (\Exception $e) {
                Log::error('Channel authorization error', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                return false;
            }
        });
    }
} 