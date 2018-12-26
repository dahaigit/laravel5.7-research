<?php
namespace App\Channels;

use Illuminate\Notifications\Notification;
class MyChannel
{
    /*
     * 实现发送消息的方法
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toMy($notifiable);
        dd($message);
    }
}
