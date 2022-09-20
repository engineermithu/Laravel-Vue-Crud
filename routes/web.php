<?php

use Illuminate\Support\Facades\Route;
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
    return view('welcome');
});

Route::get('/crud',[HomeController::class, 'index']);
Route::post('/student/store',[HomeController::class, 'store']);
Route::get('/student/edit/{id}',[HomeController::class, 'edit']);
Route::get('/student/getData',[HomeController::class, 'show']);
Route::delete('/delete/student/{id}',[HomeController::class, 'destroy']);
Route::patch('/student/update/{id}',[HomeController::class, 'update']);
