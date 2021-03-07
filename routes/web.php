<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;

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
    return redirect('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::group(['middleware' => ['auth']], function() {
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::get('/get-students', [App\Http\Controllers\UserController::class, 'get_students'])->name('users.get_students');
    Route::get('account/change_password', [App\Http\Controllers\AccountController::class, 'change_password'])->name('change_password');
    Route::post('account/update_password', [App\Http\Controllers\AccountController::class, 'update_password'])->name('update_password');
    Route::get('account/edit_profile', [App\Http\Controllers\AccountController::class, 'edit_profile'])->name('edit_profile');
    Route::post('account/update_profile', [App\Http\Controllers\AccountController::class, 'update_profile'])->name('update_profile');
    Route::get('request/add_request', [App\Http\Controllers\RequestController::class, 'create'])->name('add_request');
    Route::post('request/create_request', [App\Http\Controllers\RequestController::class, 'store'])->name('create_request');
    Route::get('request/all_requests', [App\Http\Controllers\RequestController::class, 'index'])->name('all_request');
});

//Route::resource('products', ProductController::class);
// Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
// Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');    
// Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
// Route::put('/users/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
// Route::delete('/users', [App\Http\Controllers\UserController::class ,'destroy'])->name('users.destroy');
// Route::get('/users/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');
// Route::get('/users/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
