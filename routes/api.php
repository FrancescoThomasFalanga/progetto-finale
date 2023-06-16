<?php

use App\Http\Controllers\Api\DishApiController;
use App\Http\Controllers\Api\ResturantApiController;
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

Route::get('resturant', [ResturantApiController::class, 'index']);
Route::get('resturant/{slug}', [ResturantApiController::class, 'show']);
Route::get('resturant/{slug}/dishes', [DishApiController::class, 'index']);
// Route::get('resturant/{slug}/dish/{slug}', [DishApiController::class, 'show']);
