<?php

use App\Http\Controllers\DishesController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/home', [OrderController::class, 'index'])->name('home');
Route::resource('dish',DishesController::class);

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false,
  ]);