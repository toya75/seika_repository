<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Study_memoryController;
use App\Http\Controllers\Study_summaryController;
use App\Http\Controllers\GachaController;


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

Route::controller(Study_memoryController::class)->middleware(['auth'])->group(function(){

    Route::get('/calendar', 'memory_show')->name("memory_show");
    Route::post('/calendar/create', 'memory_create')->name("memory_create");
    Route::post('/calendar/get', 'memory_get')->name("memory_get");
    Route::put('/calendar/update', 'memory_update')->name("memory_update"); // 予定の更新
    Route::delete('/calendar/delete', 'memory_delete')->name("memory_delete"); // 予定の削除
});

Route::controller(Study_summaryController::class)->middleware(['auth'])->group(function(){

    Route::get('/summary', 'summary_show')->name("summary_show");
});

Route::controller(GachaController::class)->middleware(['auth'])->group(function(){

    Route::get('/gacha', 'gacha_show')->name("gacha_show");
});



require __DIR__.'/auth.php';
