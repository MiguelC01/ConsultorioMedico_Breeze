<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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
/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/
Route::controller(App\Http\Controllers\HomeController::class)->group(function (){
Route::get('/home',[HomeController::class, 'index'])->middleware('auth')->name('home');
Route::get('/home/edit{id}',[HomeController::class, 'edit'])->middleware('auth')->name('home.edit');
Route::put('/home/update{id}',[HomeController::class, 'update'])->middleware('auth')->name('home.update');
Route::delete('/home/delete{id}',[HomeController::class, 'destroy'])->middleware('auth')->name('home.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
