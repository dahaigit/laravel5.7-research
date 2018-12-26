<?php

namespace App\Listeners;

use App\Events\OrderOk;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SayOk
{
    use InteractsWithQueue;



    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderOk  $event
     * @return void
     */
    public function handle(OrderOk $event)
    {
        \Log::info('event queue');
    }
}
