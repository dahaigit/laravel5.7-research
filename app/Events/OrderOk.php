<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderOk implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $age = 18;

    /**
     * 事件被推送到的队列名称。
     *
     * @var string
     */
    public $broadcastQueue = 'default';

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * 指定广播数据。
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'username' => 'dahai',
            'email' => '2210411072@qq.com',
        ];
    }

    public function broadcastAs()
    {
        return 'sayOk';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('project');
    }

    /**
     * 判定事件是否可以广播。
     *
     * @return bool
     */
//    public function broadcastWhen()
//    {
//        return true;
//    }
}
