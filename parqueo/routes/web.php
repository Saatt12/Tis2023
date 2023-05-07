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
//Requests
Route::get('/requests', [App\Http\Controllers\HomeController::class, 'list_requests'])->name('request');
Route::post('/requests', [App\Http\Controllers\HomeController::class, 'assign_request'])->name('request.store');
Route::post('/search_request', [App\Http\Controllers\HomeController::class, 'search_request'])->name('search_request');
Route::delete('/requests', [App\Http\Controllers\HomeController::class, 'remove_request'])->name('request.delete');
Route::put('/manual_request', [App\Http\Controllers\HomeController::class, 'manual_request'])->name('request.update');
//Claims
Route::get('/claims', [App\Http\Controllers\HomeController::class, 'list_claims'])->name('claims');
Route::get('/claims_messages/{claim_id}', [App\Http\Controllers\HomeController::class, 'claims_messages'])->name('claims_messages');
Route::post('/send_claim_message', [App\Http\Controllers\HomeController::class, 'send_claim_message'])->name('send_claim_message');
Route::get('/messages_emails', [App\Http\Controllers\HomeController::class, 'messages_emails'])->name('messages_emails');
Route::post('/messages_emails', [App\Http\Controllers\HomeController::class, 'messages_emails_store'])->name('messages_emails.store');
Route::delete('/messages_emails', [App\Http\Controllers\HomeController::class, 'messages_emails_remove'])->name('messages_emails.delete');

//Parkings
Route::get('/parking', [App\Http\Controllers\HomeController::class, 'parking'])->name('parking.index');
Route::get('/vehicles', [App\Http\Controllers\HomeController::class, 'vehicles'])->name('parking.vehicles');
Route::post('/search_vehicles', [App\Http\Controllers\HomeController::class, 'search_vehicles'])->name('search_vehicles');


//CLIENTES
Route::prefix('client')->group(function () {
    Route::controller(App\Http\Controllers\ClientController::class)->group(function () {
        Route::get('/', 'index')->name('home_client');
        //register vehicle
        Route::post('/vehicle','vehicle_store')->name('vehicle.store');
        Route::get('/vehicles','vehicles')->name('vehicles');
        Route::get('/vehicle','vehicle_create')->name('vehicle.show');
        //payment
        Route::post('/payment','payment_store')->name('payment.store');
        Route::get('/payments','payments')->name('payments');
        //Request
        Route::post('/request_form','request_form')->name('request_form.store');
        //Claims
        Route::get('/claims','claims')->name('claims.index');
        Route::post('/claim','claim_store')->name('claim.store');
    });
   /* Route::get('/', [App\Http\Controllers\ClientController::class, 'index'])->name('home_client');
    //register vehicle
    Route::post('/vehicle', [App\Http\Controllers\ClientController::class, 'vehicle_create'])->name('vehicle.create');
    Route::get('/vehicles', [App\Http\Controllers\ClientController::class, 'vehicle_create'])->name('vehicles');*/
});
