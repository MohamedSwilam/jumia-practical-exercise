<?php

namespace App\Providers;

use App\Http\Responses\CrudResponse;
use Illuminate\Support\ServiceProvider;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('CrudResponse',function() {
            return new CrudResponse();
        });
    }
}
