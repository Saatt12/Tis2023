<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Rol;
use App\Models\Unidad;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Cargo;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            "ci"=>['min:5'],
            "celular"=>['min:7'],
            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function showRegistrationForm()
    {
        $cargos = Cargo::all();
        $unidades = Unidad::all();
        return view('auth.register',)->with(["cargos"=>$cargos,"unidades"=>$unidades]);
    }
    protected function create(array $data)
    {
        $role_client = Rol::where('nom_role','CLIENTE')->first();
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'cargo_id' => $data['cargo_id'],
            'unidad_id' => $data['unidad_id'],
            'celular' => $data['celular'],
            'ci' => $data['ci'],
            'rol_id'=>$role_client->id,
            'password' => Hash::make($data['password']),
        ]);
    }
}
