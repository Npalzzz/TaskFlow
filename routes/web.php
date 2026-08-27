<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Dashboard User
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');


    /*
    |--------------------------------------------------------------------------
    | Categories
    |--------------------------------------------------------------------------
    */

    Route::resource('categories', CategoryController::class);


    /*
    |--------------------------------------------------------------------------
    | Tasks
    |--------------------------------------------------------------------------
    */

    Route::resource('tasks', TaskController::class);


    /*
    |--------------------------------------------------------------------------
    | Notifications
    |--------------------------------------------------------------------------
    */

    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');

    Route::get('/notifications/latest', [NotificationController::class, 'latest'])
        ->name('notifications.latest');

    Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])
        ->name('notifications.read');

    Route::post('/notifications/{notification}/read-ajax', [NotificationController::class, 'markAsReadAjax'])
        ->name('notifications.read.ajax');

    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])
        ->name('notifications.read.all');
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Hanya user dengan role "admin" yang dapat mengakses
| seluruh route di bawah ini.
|
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Admin Dashboard & Statistik
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [AdminController::class, 'index'])
            ->name('admin.dashboard');


        /*
        |--------------------------------------------------------------------------
        | Task Monitoring (Read-Only)
        |--------------------------------------------------------------------------
        */

        Route::get('/tasks/monitoring', [AdminController::class, 'monitorTasks'])
            ->name('admin.tasks.monitoring');


        /*
        |--------------------------------------------------------------------------
        | User Management
        |--------------------------------------------------------------------------
        */

        Route::get('/users', [AdminController::class, 'users'])
            ->name('admin.users');

        Route::get('/users/create', [AdminController::class, 'createUser'])
            ->name('admin.users.create');

        Route::post('/users', [AdminController::class, 'storeUser'])
            ->name('admin.users.store');

        Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])
            ->name('admin.users.edit');

        Route::put('/users/{user}', [AdminController::class, 'updateUser'])
            ->name('admin.users.update');

        Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])
            ->name('admin.users.destroy');
    });


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';