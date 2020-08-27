<?php

namespace App\Events;

use App\Models\Users\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class OrderPerformed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $user;
    public string $state;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, string $state = 'paid')
    {
        $this->user = $user;
        $this->state = $state;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
