<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WeatherAppController;

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

Route::get('/get-weather/{location?}', [WeatherAppController::class, "getWeather"]);

Route::get('/get-hourly-weather/{datetime}/{lat}/{lon}', [WeatherAppController::class, "getHourlyWeather"]);

Route::get('/get-days-weather/{lat}/{lon}', [WeatherAppController::class, "getDaysWeather"]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
