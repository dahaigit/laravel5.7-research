<?php

namespace App\Console\Commands;

use App\Mail\OrderShipped;
use App\User;
use Illuminate\Console\Command;

class sendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send {userId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '发送邮件给用户';

    public $orderShipped;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(OrderShipped $orderShipped)
    {
        parent::__construct();
        $this->orderShipped = $orderShipped;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo 1111;
    }
}
