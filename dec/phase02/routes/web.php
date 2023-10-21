<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\Calendar;
use App\Http\Controllers\ScheduleController;
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


Route::resource('schedule', ScheduleController::class);

Route::get('/create', [ScheduleController::class,'create'])->name('schedule.create');
Route::get('/destroy', [ScheduleController::class,'destroy'])->name('schedule.destroy');

Route::get('/thismonth', [CalendarController::class,'thismonth'])->name('calendar.thismonth');
Route::post('calendar/redirect', [CalendarController::class,'redirect'])->name('calendar.redirect');

Route::get('/{year}/{month}', [CalendarController::class,'show'])
	->where(['year' => '[0-9]+', 'month' => '[0-9]+'])->name('calendar.show');

Route::get('/', function () {
     return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//祝日設定
Route::get('/holiday_setting', [Calendar\HolidaySettingController::class,'form'])
    ->name("holiday_setting");
Route::post('/holiday_setting', [Calendar\HolidaySettingController::class,'update'])
    ->name("update_holiday_setting");

require __DIR__.'/auth.php';

