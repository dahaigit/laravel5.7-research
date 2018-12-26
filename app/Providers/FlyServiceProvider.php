<?php

namespace App\Providers;

use App\Common\Fly;
use Illuminate\Support\ServiceProvider;

class FlyServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // 普通绑定
        $this->app->bind('fly' , function($app, $arg){
            $high = isset($arg['high']) ? $arg['high'] : $app['config']['fly']['high'];
            return new Fly($high);
        });
    }
}
