<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return view('welcome');
});




Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');




Route::middleware('auth')->group(function () {

    

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');


    

    Route::resource('categories', CategoryController::class);


   

    Route::resource('tasks', TaskController::class);


    

    Route::get('/admin/dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard');


    
    Route::get('/admin/users', [AdminController::class, 'users'])
        ->name('admin.users');

    
    Route::get('/admin/users/create', [AdminController::class, 'createUser'])
        ->name('admin.users.create');

   
    Route::post('/admin/users', [AdminController::class, 'storeUser'])
        ->name('admin.users.store');

  
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])
        ->name('admin.users.edit');

    
    Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])
        ->name('admin.users.update');

    
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])
        ->name('admin.users.destroy');
});




require __DIR__ . '/auth.php';