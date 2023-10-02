<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WordController;
use App\Http\Controllers\SearchController;
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

Route::middleware('auth')->group(function () {
    Route::get('/word/search/input', [SearchController::class, 'create'])->name('search.input');
    Route::get('/word/search/result_1', [SearchController::class, 'index1'])->name('search.result_1');
    Route::get('/word/search/result_2', [SearchController::class, 'index2'])->name('search.result_2');
    Route::get('/word/search/result_3', [SearchController::class, 'index3'])->name('search.result_3');
    Route::get('/word/mypage', [WordController::class, 'mydata'])->name('word.mypage');
    Route::resource('word', WordController::class);
});

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

require __DIR__.'/auth.php';
