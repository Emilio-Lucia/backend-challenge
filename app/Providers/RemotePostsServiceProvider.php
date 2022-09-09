<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\RemotePostsService;

class RemotePostsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind( RemotePostsService::class, function( $app ) {

            return new RemotePostsService();

        } );

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
