<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiCovidController;

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

Route::get('covid/positif',[ApiCovidController::class, 'positif']);
Route::get('covid/recovered',[ApiCovidController::class, 'recovered']);
Route::get('covid/deaths',[ApiCovidController::class, 'death']);
Route::get('covid/country',[ApiCovidController::class, 'world']);

Route::get('indonesia/cases',[ApiCovidController::class, 'indonesiaCase']);
Route::get('indonesia',[ApiCovidController::class, 'indonesia']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
