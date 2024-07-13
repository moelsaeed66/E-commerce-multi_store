<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductsController;
use App\Http\Controllers\Front\TwoFactorAuthenticationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('dashboard',DashboardController::class)->name('dashboard');
Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('product',[ProductsController::class,'index'])->name('product.index');

Route::get('product/{product:slug}',[ProductsController::class,'show'])->name('product.show');

Route::resource('cart', CartController::class);

Route::get('checkout',[CheckoutController::class,'create'])->name('checkout.create');
Route::post('checkout',[CheckoutController::class,'store'])->name('checkout.store');


Route::get('auth/user/two-factor', TwoFactorAuthenticationController::class)->name('front.two-factor');
//
//Route::get('/dash', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


//require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';

