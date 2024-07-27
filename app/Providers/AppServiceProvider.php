<?php

namespace App\Providers;

use App\Services\CurrencyConverter;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('currency_converter',function (){
            return new CurrencyConverter(config('Services.currency_converter.api_key'));
        });
        if(App::environment('production')){
            $this->app->singleton('public.path',function (){
                return base_path('/../public_html');
            });
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        App::setLocale(request('locale','en'));
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
