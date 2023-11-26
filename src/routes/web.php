<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;

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

Route::middleware('auth')->group(function () {
    Route::get('/', [AttendanceController::class, 'home']);
    Route::post('/clock-in', [AttendanceController::class, 'clockIn']);
    Route::patch('/clock-out', [AttendanceController::class, 'clockOut']);
    Route::patch('/break-begin', [AttendanceController::class, 'breakBegin']);
    Route::patch('/break-end', [AttendanceController::class, 'breakEnd']);
    Route::get('/attendance/{date?}', [AttendanceController::class, 'showAttendanceList']);
    // Route::prefix('attendance/')->group(function () {
        

    // });
});
