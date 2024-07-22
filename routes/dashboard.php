<?php


use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\RolesController;
use App\Http\Middleware\CheckUserType;
use Illuminate\Support\Facades\Route;
//
//Route::get('/dashboard',[DashboardController::class,'index'])
//    ->middleware(['auth'])
//    ->name('dashboard');
Route::group([
    'middleware'=>['auth:admin,wed'],

    'prefix'=>'admin/dashboard/'
],function (){
//    dd('hello');
    Route::get('/',DashboardController::class)->name('dashboard');
    Route::get('categories/trash',[CategoriesController::class,'trash'])->name('categories.trash');
    Route::put('categories/{category}/restore',[CategoriesController::class,'restore'])->name('categories.restore');
    Route::get('categories/soft-delete',[CategoriesController::class,'softDelete'])->name('categories.soft-delete');

    //profile

    Route::get('profiles',[ProfileController::class,'edit'])->name('profiles.edit');
    Route::patch('profiles',[ProfileController::class,'update'])->name('profiles.update');


    //categories
    Route::resource('categories', CategoriesController::class);

    //products
    Route::resource('products', ProductController::class);

    //Roles
    Route::resource('roles', RolesController::class);


});



