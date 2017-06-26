<?php
/**
 * Created by PhpStorm.
 * User: smatt
 * Date: 23/06/2017
 * Time: 05:19 PM
 */

namespace FormStack\Providers;


use Illuminate\Support\ServiceProvider;

class FSServiceProvider extends ServiceProvider {


    public function boot()
    {
        $this->publishes([
            __DIR__.'/formstack.php' => config_path('formstack.php'),
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}