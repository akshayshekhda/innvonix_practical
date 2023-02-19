<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
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
    return view('auth.login');
});
//Login And Sign up Route
Route::get('/', [LoginController::class, 'showLoginForm'])->name('home');
Route::post('/signup', [RegisterController::class, 'create'])->name('signup');
Route::post('/login', [LoginController::class, 'LoginCheck'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//Project And Task Route All
Route::group(['prefix' => '/', 'middleware' => ['auth']], function () {
    Route::resource('projectlist',ProjectController::class);//Project 
    Route::resource('tasklist',TaskController::class);//Task 
});