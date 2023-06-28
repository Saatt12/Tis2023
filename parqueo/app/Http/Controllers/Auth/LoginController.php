<?php

namespace App\Http\Controllers\Auth;
use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function authenticated(Request $request, $user)
    {
        if($user->hasRoleName('CLIENTE')){
            return redirect()->route('home_client');
        }else{
            $routes = [
                "ver_cargo"=>'/cargos',
                "ver_unidad"=>'/unidades',
                "ver_rol"=>'/roles',
                "ver_clientes"=>'/home',
                "ver_solicitudes_parqueo"=>'/requests',
                "ver_empleado"=>'/employees',
                "ver_horario"=>'/horarios',
                "ver_reclamo"=>'/claims',
                "ver_parqueo"=>'/parking',
                "ver_reporte"=>'/reports',
                "ver_mensaje"=>'/conversations',
                "ver_cobros"=>'/cobros'
            ];
            $first_permission = RolePermission::where('rol_id',$user->rol_id)->first();
            if(!$first_permission) {
                Auth::logout();
                return redirect('/');
            }
            $permission = Permission::findOrFail($first_permission->permission_id);
            return redirect($routes[$permission->key]);
        }
    }
}
