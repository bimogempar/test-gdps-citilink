<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::middleware('admin')->group(function () {
        Route::get('/user-management', [UserController::class, 'userPage'])->name('user-management-page');
        Route::get('/add-user', [UserController::class, 'addUserPage'])->middleware('superadmin')->name('add-user-page');
        Route::get('/user/{userId}', [UserController::class, 'editUserPage'])->name('edit-user-page');
        Route::delete('/user/{userId}', [UserController::class, 'deleteUser'])->middleware('superadmin')->name('delete-user');
        Route::post('/user', [UserController::class, 'createUser'])->middleware('superadmin')->name('create-user');
        Route::patch('/user/{userId}', [UserController::class, 'updateUser'])->name('update-user');
    });
});

require __DIR__ . '/auth.php';
