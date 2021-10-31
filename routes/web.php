<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    return view('welcome');
})->name('home');

Route::get('/tasks', function () {
    return view('olimp.tasks');
});

Route::prefix('user')->group(function () {
    Route::get('/{id}',[UserController::class, 'ShowProfile'])->where('id', '[0-9]+')->name('profile');

    Route::post('/edit', function () {
        // Использует посредники `first` и `second` ...
    });
});

Route::prefix('post')->group(function(){

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
