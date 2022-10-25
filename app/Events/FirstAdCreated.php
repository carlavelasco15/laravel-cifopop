<?php

namespace App\Events;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FirstAdCreated
{
    use Dispatchable, SerializesModels;

    public $ad, $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Ad $ad, User $user)
    {
        $this->ad = $ad;
        $this->user = $user;
    }
}
