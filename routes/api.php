<?php

use App\Http\Controllers\Api\AccessTokenController;
use App\Http\Controllers\Api\DeliveryController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
    return Auth::guard('sanctum')->user();
});

Route::apiResource('/products', ProductController::class);

Route::post('auth/access-tokens',[AccessTokenController::class,'store'])
->middleware('guest:sanctum');

Route::delete('auth/access-tokens/{token?}',[AccessTokenController::class,'destroy'])
    ->middleware('auth:sanctum');
Route::get('deliveries/{delivery}',[DeliveryController::class,'show']);
Route::put('deliveries/{delivery}',[DeliveryController::class,'update']);
