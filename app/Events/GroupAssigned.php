<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class GroupAssigned implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $groupColor;
    public $groupName;
    public $redirectUrl;

    /**
     * Create a new event instance.
     */
    public function __construct($userId, $groupColor, $groupName, $redirectUrl)
    {
        $this->userId = $userId;
        $this->groupColor = $groupColor;
        $this->groupName = $groupName;
        $this->redirectUrl = $redirectUrl;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel
     */
    public function broadcastOn()
    {
        $channelName = 'private-user.' . $this->userId;
        Log::info('Broadcasting GroupAssigned event', [
            'user_id' => $this->userId,
            'channel' => $channelName,
            'session_id' => session()->getId(),
            'session_data' => session()->all()
        ]);
        return new PrivateChannel($channelName);
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        Log::info('Broadcasting GroupAssigned data', [
            'user_id' => $this->userId,
            'group_color' => $this->groupColor,
            'group_name' => $this->groupName,
            'redirect_url' => $this->redirectUrl,
            'session_id' => session()->getId(),
            'session_data' => session()->all()
        ]);

        return [
            'groupName' => $this->groupName,
            'redirectUrl' => $this->redirectUrl
        ];
    }

    /**
     * Determine if this event should broadcast.
     *
     * @return bool
     */
    public function broadcastWhen()
    {
        return true;
    }

    /**
     * Get the broadcast event name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'GroupAssigned';
    }
}
