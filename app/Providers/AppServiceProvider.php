<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping();
        \Illuminate\Support\Facades\Validator::extend('filter',  function($attribute,$value)
                {
                    if(strtolower($value)=='laravel')
                    {
                        return false;
                    }
                    return true;

                },'this name is hacker');

        Paginator::useBootstrap();
    }

}
