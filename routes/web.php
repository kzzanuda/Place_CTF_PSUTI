<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\AdminController;

use App\Http\Middleware\VerifyAdmin;

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
    Route::get('/{id}',[UserController::class, 'profile'])->where('id', '[0-9]+')->name('profile');
    Route::post('/edit',[UserController::class, 'update'])->name('edituser');

    // Route::get('/{id}/{task_id}',[UserController::class, 'answer'])->where('id', '[0-9]+')->where('task_id', '[0-9]+');
});

Route::prefix('task')->middleware('task_time_limit')->group(function(){
    Route::get('/list',[TasksController::class, 'index'])->name('tasks');
    Route::get('/{id}',[TasksController::class, 'show_task'])->middleware(['auth'])->name('task');
    Route::post('/{id}',[TasksController::class, 'to_answer'])->middleware(['auth'])->name('to_answer');
});

Route::prefix('admin')->middleware('admin')->group(function(){
    Route::get('/',[AdminController::class, 'index'])->name('admin_menu');
    Route::get('/users',[AdminController::class, 'users'])->name('admin_users');
    Route::get('/tasks',[AdminController::class, 'tasks'])->name('admin_tasks');
    Route::get('/edit-task/{id?}',[AdminController::class, 'add_task'])->name('admin_task');
    Route::post('/task/{id?}',[TasksController::class, 'add_task'])->where('id', '[0-9]+')->name('admin_add_task');

    Route::get('/user/{id}/task/{task_id}/',[UserController::class, 'answer'])->where('id', '[0-9]+')->where('task_id', '[0-9]+')->name('user_answer');
    Route::post('/addpoints/{id}/{task_id}/',[UserController::class, 'add_points'])->where('id', '[0-9]+')->where('task_id', '[0-9]+')->name('add_points');
    Route::get('/user/{id}',[UserController::class, 'answers'])->where('id', '[0-9]+')->name('user_answers');
});

Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
