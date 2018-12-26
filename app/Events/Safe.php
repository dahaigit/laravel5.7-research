<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Safe implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $schoolId;

    /**
     * 事件被推送到的队列名称。
     *
     * @var string
     */
//    public $broadcastQueue = '111';

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $schoolId)
    {
        $this->schoolId = $schoolId;
    }

    public function broadcastAs()
    {
        return 'safeOk';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('safe.' . $this->schoolId);
    }
}
