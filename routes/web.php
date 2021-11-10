<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\AdminController;

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

Route::prefix('user')->group(function () {
    Route::get('/{id}',[UserController::class, 'ShowProfile'])->where('id', '[0-9]+')->name('profile');

    Route::post('/edit',[UserController::class, 'UpdateUser'])->name('edituser');
});

Route::prefix('task')->group(function(){
    Route::get('/list',[TasksController::class, 'index'])->name('tasks');
    Route::get('/{id}',[TasksController::class, 'show_task'])->middleware(['auth'])->name('task');
    Route::post('/{id}',[TasksController::class, 'to_answer'])->middleware(['auth'])->name('to_answer');
});

Route::prefix('admin')->group(function(){
    Route::get('/',[AdminController::class, 'index'])->name('admin_menu');
    Route::get('/users',[AdminController::class, 'users'])->name('admin_users');
    Route::get('/tasks',[AdminController::class, 'tasks'])->name('admin_tasks');
    Route::get('/addtask',[AdminController::class, 'task_add'])->name('admin_add_task');
});

Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
