<?php


use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use Illuminate\Support\Facades\Route;
//
//Route::get('/dashboard',[DashboardController::class,'index'])
//    ->middleware(['auth'])
//    ->name('dashboard');
Route::group(['middleware'=>'auth'],function (){
    Route::get('/dashboard',DashboardController::class)
        ->name('dashboard');
    Route::get('categories/trash',[CategoriesController::class,'trash'])->name('categories.trash');
    Route::put('categories/{category}/restore',[CategoriesController::class,'restore'])->name('categories.restore');
    Route::get('categories/soft-delete',[CategoriesController::class,'softDelete'])->name('categories.soft-delete');

    //profile

    Route::get('profiles',[ProfileController::class,'edit'])->name('profiles.edit');
    Route::patch('profiles',[ProfileController::class,'update'])->name('profiles.update');




    Route::resource('dashboard/categories', CategoriesController::class);
    Route::resource('dashboard/products', ProductController::class);


});



