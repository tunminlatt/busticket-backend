<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusController;
use App\Http\Controllers\SeatingPlanController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\BookingController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('buses', BusController::class);
    Route::resource('buses.seating-plans', SeatingPlanController::class)->shallow();
    Route::resource('buses.prices', PriceController::class)->shallow();
    Route::resource('bookings', BookingController::class);
});

