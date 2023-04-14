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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Auth::routes();
//clientes
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::delete('/users/{id}', [App\Http\Controllers\HomeController::class, 'destroy'])->name('users.destroy');
Route::get('/users/{id}', [App\Http\Controllers\HomeController::class, 'show'])->name('users.show');
Route::put('/users/{id}',  [App\Http\Controllers\HomeController::class, 'update'])->name('users.update');
//empleados

//horarios
Route::get('/horarios', [App\Http\Controllers\HomeController::class, 'list_horarios'])->name('horario');
Route::get('/horarios/create', [App\Http\Controllers\HomeController::class, 'horarios_create'])->name('horario.create');
Route::post('/horarios', [App\Http\Controllers\HomeController::class, 'horarios_store'])->name('horario.store');
