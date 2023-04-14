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
//ADMINISTRADOR
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
Route::get('/horarios/{id}', [App\Http\Controllers\HomeController::class, 'horario_show'])->name('horario.show');
Route::put('/horarios/{id}',  [App\Http\Controllers\HomeController::class, 'horario_update'])->name('horario.update');
Route::delete('/horarios/{id}', [App\Http\Controllers\HomeController::class, 'horario_destroy'])->name('horario.destroy');

//horarios
Route::get('/employees', [App\Http\Controllers\HomeController::class, 'list_employees'])->name('employee');
Route::get('/employees/create', [App\Http\Controllers\HomeController::class, 'employees_create'])->name('employee.create');
Route::post('/employees', [App\Http\Controllers\HomeController::class, 'employees_store'])->name('employee.store');
Route::get('/employees/{id}', [App\Http\Controllers\HomeController::class, 'employee_show'])->name('employee.show');
Route::put('/employees/{id}',  [App\Http\Controllers\HomeController::class, 'employee_update'])->name('employee.update');
Route::delete('/employees/{id}', [App\Http\Controllers\HomeController::class, 'employee_destroy'])->name('employee.destroy');

//CLIENTES
Route::get('/client', [App\Http\Controllers\ClientController::class, 'index'])->name('home_client');
//Route::post('/client', [YourController::class, 'store'])->name('your-route-name');
