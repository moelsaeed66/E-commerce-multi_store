<?php

namespace App\Providers;

use App\Repositories\Cart\CartModelRepository;
use App\Repositories\Cart\CartRepository;
use Illuminate\Support\ServiceProvider;

class CartServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
//        $this->app->bind('cart', function () {
//            return new CartModelRepository();
//        });


                $this->app->bind(CartRepository::class, function () {
            return new CartModelRepository();
        });

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
