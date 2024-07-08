<?php


use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Middleware\CheckUserType;
use Illuminate\Support\Facades\Route;
//
//Route::get('/dashboard',[DashboardController::class,'index'])
//    ->middleware(['auth'])
//    ->name('dashboard');
Route::group([
    'middleware'=>['auth','auth.type:admin'],
],function (){
    Route::get('/dashboard',DashboardController::class)->name('dashboard');
    Route::get('categories/trash',[CategoriesController::class,'trash'])->name('categories.trash');
    Route::put('categories/{category}/restore',[CategoriesController::class,'restore'])->name('categories.restore');
    Route::get('categories/soft-delete',[CategoriesController::class,'softDelete'])->name('categories.soft-delete');

    //profile

    Route::get('profiles',[ProfileController::class,'edit'])->name('profiles.edit');
    Route::patch('profiles',[ProfileController::class,'update'])->name('profiles.update');


    //categories
    Route::resource('dashboard/categories', CategoriesController::class);

    //products
    Route::resource('dashboard/products', ProductController::class);


});



