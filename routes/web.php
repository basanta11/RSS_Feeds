<?php

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


Route::get('/',[App\Http\Controllers\HomeController::class, 'home']);

//Connectiong  to APi
Route::post('/post/section',[App\Http\Controllers\RssFeedController::class, 'getFeeds'])->name('section.post');

Auth::routes();

