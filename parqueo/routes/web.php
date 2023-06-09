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
Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login_admin');
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
//cargos
Route::get('/cargos', [App\Http\Controllers\HomeController::class, 'list_cargos'])->name('cargo');
Route::get('/cargos/create', [App\Http\Controllers\HomeController::class, 'cargos_create'])->name('cargo.create');
Route::post('/cargos', [App\Http\Controllers\HomeController::class, 'cargos_store'])->name('cargo.store');
Route::get('/cargos/{id}', [App\Http\Controllers\HomeController::class, 'cargo_show'])->name('cargo.show');
Route::put('/cargos/{id}',  [App\Http\Controllers\HomeController::class, 'cargo_update'])->name('cargo.update');
Route::delete('/cargos/{id}', [App\Http\Controllers\HomeController::class, 'cargo_destroy'])->name('cargo.destroy');
//unidades
Route::get('/unidades', [App\Http\Controllers\HomeController::class, 'list_unidades'])->name('unidad');
Route::get('/unidades/create', [App\Http\Controllers\HomeController::class, 'unidades_create'])->name('unidad.create');
Route::post('/unidades', [App\Http\Controllers\HomeController::class, 'unidades_store'])->name('unidad.store');
Route::get('/unidades/{id}', [App\Http\Controllers\HomeController::class, 'unidad_show'])->name('unidad.show');
Route::put('/unidades/{id}',  [App\Http\Controllers\HomeController::class, 'unidad_update'])->name('unidad.update');
Route::delete('/unidades/{id}', [App\Http\Controllers\HomeController::class, 'unidad_destroy'])->name('unidad.destroy');
//roles
Route::get('/roles', [App\Http\Controllers\HomeController::class, 'list_roles'])->name('role');
Route::get('/roles/create', [App\Http\Controllers\HomeController::class, 'roles_create'])->name('role.create');
Route::post('/roles', [App\Http\Controllers\HomeController::class, 'roles_store'])->name('role.store');
Route::get('/roles/{id}', [App\Http\Controllers\HomeController::class, 'role_show'])->name('role.show');
Route::put('/roles/{id}',  [App\Http\Controllers\HomeController::class, 'role_update'])->name('role.update');
Route::delete('/roles/{id}', [App\Http\Controllers\HomeController::class, 'role_destroy'])->name('role.destroy');

//employees
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
//Cobros
Route::get('/cobros', [App\Http\Controllers\HomeController::class, 'list_cobros'])->name('cobros');
Route::post('/verified_payment', [App\Http\Controllers\HomeController::class, 'cobros_verified'])->name('cobro.verified');
Route::post('/cobros', [App\Http\Controllers\HomeController::class, 'cobros_store'])->name('cobro.store');
Route::post('/search_cobros_payments', [App\Http\Controllers\HomeController::class, 'search_cobros_payments'])->name('cobro.search');

//Parkings
Route::get('/parking', [App\Http\Controllers\HomeController::class, 'parking'])->name('parking.index');
Route::get('/vehicles', [App\Http\Controllers\HomeController::class, 'vehicles'])->name('parking.vehicles');
Route::post('/search_vehicles', [App\Http\Controllers\HomeController::class, 'search_vehicles'])->name('search_vehicles');

//Announcement
Route::get('/announcements', [App\Http\Controllers\HomeController::class, 'list_announcements'])->name('announcement');
Route::get('/announcements/create', [App\Http\Controllers\HomeController::class, 'announcement_create'])->name('announcement.create');
Route::post('/announcements', [App\Http\Controllers\HomeController::class, 'announcement_store'])->name('announcement.store');
//Route::get('/announcements/{id}', [App\Http\Controllers\HomeController::class, 'announcement_show'])->name('announcement.show');
//Route::put('/announcements/{id}',  [App\Http\Controllers\HomeController::class, 'announcement_update'])->name('announcement.update');
//Route::delete('/announcements/{id}', [App\Http\Controllers\HomeController::class, 'announcement_destroy'])->name('announcement.destroy');

//Hours Vehicles
/*Route::get('/hours_vehicles', [App\Http\Controllers\HomeController::class, 'list_hours_vehicles'])->name('hours_vehicle');
Route::get('/hours_vehicles/create', [App\Http\Controllers\HomeController::class, 'hours_vehicles_create'])->name('hours_vehicle.create');*/
Route::post('/hours_vehicles', [App\Http\Controllers\HomeController::class, 'hours_vehicles_store'])->name('hours_vehicle.store');
/*Route::get('/hours_vehicles/{id}', [App\Http\Controllers\HomeController::class, 'hours_vehicle_show'])->name('hours_vehicle.show');
Route::put('/hours_vehicles/{id}',  [App\Http\Controllers\HomeController::class, 'hours_vehicle_update'])->name('hours_vehicle.update');
Route::delete('/hours_vehicles/{id}', [App\Http\Controllers\HomeController::class, 'hours_vehicle_destroy'])->name('hours_vehicle.destroy');*/

//Reports
Route::get('/reports', [App\Http\Controllers\HomeController::class, 'reports'])->name('reports');
Route::get('/reports/users', [App\Http\Controllers\HomeController::class, 'reports_users'])->name('reports_users');
Route::get('/reports/payments', [App\Http\Controllers\HomeController::class, 'reports_payments'])->name('reports_payments');
Route::get('/reports/announcement', [App\Http\Controllers\HomeController::class, 'reports_announcement'])->name('reports_announcement');
Route::post('/reports/users', [App\Http\Controllers\HomeController::class, 'export_reports_users'])->name('export_report_users');
Route::post('/reports/payments', [App\Http\Controllers\HomeController::class, 'export_reports_payments'])->name('export_report_payments');
Route::post('/reports/announcement', [App\Http\Controllers\HomeController::class, 'export_reports_announcement'])->name('export_report_announcement');
Route::post('/search_reports/users', [App\Http\Controllers\HomeController::class, 'search_reports_users'])->name('search_report_users');
Route::post('/search_reports/payments', [App\Http\Controllers\HomeController::class, 'search_reports_payments'])->name('search_report_payments');
Route::post('/search_reports/announcement', [App\Http\Controllers\HomeController::class, 'search_reports_announcement'])->name('search_report_announcement');


//Conversation
Route::get('/conversations', [App\Http\Controllers\HomeController::class, 'list_conversations'])->name('conversations');
Route::get('/conversations_messages/{conversation_id}', [App\Http\Controllers\HomeController::class, 'conversations_messages'])->name('conversations_messages');
Route::post('/send_conversation_message', [App\Http\Controllers\HomeController::class, 'send_conversation_message'])->name('send_conversation_message');
Route::get('/conversation_emails', [App\Http\Controllers\HomeController::class, 'conversation_emails'])->name('conversation_emails');
Route::post('/conversation_emails', [App\Http\Controllers\HomeController::class, 'conversation_emails_store'])->name('conversation_emails.store');
Route::delete('/conversation_emails', [App\Http\Controllers\HomeController::class, 'conversation_emails_remove'])->name('conversation_emails.delete');


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
        Route::post('/export_payment_factura','export_payment_factura')->name('export_payment_factura');
        //Request
        Route::post('/request_form','request_form')->name('request_form.store');
        //Claims
        Route::get('/claims','claims')->name('claims.index');
        Route::post('/claim','claim_store')->name('claim.store');

        //Conversation
        Route::get('/conversations',  'list_conversations')->name('conversations_client');
        Route::get('/conversations_messages/{conversation_id}',  'conversations_messages')->name('conversations_messages_client');
        Route::post('/send_conversation_message',  'send_conversation_message')->name('send_conversation_message_client');
        Route::get('/conversation_emails',  'conversation_emails')->name('conversation_emails_client');
        Route::post('/conversation_emails',  'conversation_emails_store')->name('conversation_emails.store_client');
        Route::delete('/conversation_emails',  'conversation_emails_remove')->name('conversation_emails.delete_client');
        //Clear Notification
        Route::post('/clear_notification',  'clear_notification')->name('clear_notification');
    });
   /* Route::get('/', [App\Http\Controllers\ClientController::class, 'index'])->name('home_client');
    //register vehicle
    Route::post('/vehicle', [App\Http\Controllers\ClientController::class, 'vehicle_create'])->name('vehicle.create');
    Route::get('/vehicles', [App\Http\Controllers\ClientController::class, 'vehicle_create'])->name('vehicles');*/
});

Route::get('/linkstorage', function () {
    \Illuminate\Support\Facades\Artisan::call('storage:link'); // this will do the command line job
    echo "test";
});
Route::get('/create-symlink1', function() {
    app('files')->link(storage_path('app/public'), public_path('storage'));
    echo "test";
});
Route::get('/link', function () {
    $target = '/home/public_html/storage/app/public';
    $shortcut = '/home/public_html/public/storage';
    symlink($target, $shortcut);
    echo "test";
});
