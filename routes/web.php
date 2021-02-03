<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MitraController;
use App\Models\MitraRs;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages/index');
});

Route::get('Indonesia-case',function(){
    return view('pages/indonesia-case');
});

Route::get('admin/login', function(){
    return view('login');
})->name('login');

Route::get('admin/logout',[loginController::class,'logout'])->name('logout');

Route::post('admin/login',[loginController::class,'login']);

// Route::get('mitra-covid',function(){
//     return view('pages/mitra-covid');
// });
route::get('mitra-all',[MitraController::class,'getMitra'])->name('Mitra-All');

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('admin/dashboard',function(){
        return view('pages-admin/dashboard');
    })->name('dashboard');

    //MitraRs
    Route::get('admin/mitra',function(){
        return view('pages-admin/mitra');
    })->name('mitra');

    Route::resource('admin/mitra-rs', MitraController::class)->except([
        'update', 'destroy'
    ]);
    
    Route::put('admin/mitra-rs', [MitraController::class,'update']);
    Route::delete('admin/mitra-rs', [MitraController::class,'destroy']);

    Route::get('download-mitra',[MitraController::class,'downloadMitra']);

    Route::post('upload/mitra', [MitraController::class,'uploadMitra']);
    
});