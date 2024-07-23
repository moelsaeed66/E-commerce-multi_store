<?php


use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ImportProductController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\RolesController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Middleware\CheckUserType;
use Illuminate\Support\Facades\Route;
//
//Route::get('/dashboard',[DashboardController::class,'index'])
//    ->middleware(['auth'])
//    ->name('dashboard');
Route::group([
    'middleware'=>['auth:admin'],

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

    //Roles
    Route::resource('roles', RolesController::class);

    //admins
    Route::resource('admins', AdminController::class);

    //users
    Route::resource('users', UsersController::class);

    //import
    Route::get('products/import',[ImportProductController::class,'create'])->name('products.import');
    Route::post('products/import',[ImportProductController::class,'store']);

    //products
    Route::resource('products', ProductController::class);




});



