<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TasksController;

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

Route::get('/tasks',[TasksController::class, 'ShowTasks'])->name('tasks');
Route::get('/task/{id}',[TasksController::class, 'ShowTaskById'])->name('taskid');

Route::prefix('user')->group(function () {
    Route::get('/{id}',[UserController::class, 'ShowProfile'])->where('id', '[0-9]+')->name('profile');

    Route::post('/edit',[UserController::class, 'UpdateUser'])->name('edituser');
});

Route::prefix('post')->group(function(){

});

Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
