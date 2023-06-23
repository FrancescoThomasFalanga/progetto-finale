<?php

use App\Http\Controllers\Api\DishApiController;
use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\Api\RestaurantApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('restaurants', [RestaurantApiController::class, 'index']);
Route::get('restaurants/{restaurant:slug}', [RestaurantApiController::class, 'show']);
Route::post('orders', [OrderApiController::class, 'store']);
Route::post('leads', [LeadController::class, 'store']);
