<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ScoreboardController;

use App\Http\Middleware\AuthenticateCheck;

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

Route::middleware([AuthenticateCheck::class])->group(function () {
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/{id}', [UserController::class, 'profile'])->name('profile');
        Route::post('/edit', [UserController::class, 'update'])->name('edit');
    });

    Route::prefix('tasks')->name('tasks.')->middleware('task_time_limit')->group(function () {
        Route::get('/list', [TasksController::class, 'index'])->name('list');
        Route::get('/task/{id}', [TasksController::class, 'showTask'])->name('task');
        Route::post('/answer/{id}', [TasksController::class, 'toAnswer'])->name('answer');
    });

    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');

        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/list', [AdminController::class, 'users'])->name('list');

            Route::post('/block/{id}', [UserController::class, 'block'])->name('block');
            Route::post('/unblock/{id}', [UserController::class, 'unblock'])->name('unblock');
        });

        Route::prefix('tasks')->name('tasks.')->group(function () {
            Route::get('/list', [AdminController::class, 'tasks'])->name('list');
            Route::get('/task/{id}', [AdminController::class, 'task'])->name('task');
            Route::get('/add', [AdminController::class, 'taskAdd'])->name('add_form');
            Route::get('/edit/{id}', [AdminController::class, 'taskEdit'])->name('edit_form');

            Route::post('/task/add', [TasksController::class, 'add'])->name('add_post');
            Route::post('/task/edit/{id}', [TasksController::class, 'edit'])->name('edit_post');
            Route::post('/task/restore/{id}', [TasksController::class, 'restore'])->name('restore');

            Route::delete('/delete/{id}', [TasksController::class, 'delete'])->name('delete');
        });

        Route::get('/user/{id}/task/{task_id}/', [UserController::class, 'answer'])->where('id', '[0-9]+')->where('task_id', '[0-9]+')->name('user_answer');
        Route::post('/addpoints/{id}/{task_id}/', [UserController::class, 'add_points'])->where('id', '[0-9]+')->where('task_id', '[0-9]+')->name('add_points');
        Route::get('/user/{id}', [UserController::class, 'answers'])->where('id', '[0-9]+')->name('user_answers');
    });

    Route::get('/scoreboard', [ScoreboardController::class, 'index'])->name('scoreboard');
    Route::get('/masters', function() {
      return view('olimp.masters');
    })->name('masters');
});

Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
