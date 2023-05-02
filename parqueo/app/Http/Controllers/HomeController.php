<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Horario;
use App\Models\Rol;
use App\Models\Unidad;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $role_client;
    protected $role_employee_ids;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $role_client = Rol::where('nom_role','CLIENTE')->first();
        $this->role_employee_ids = Rol::where('nom_role','!=','CLIENTE')->where('id','!=','1')->pluck('id');
        $this->role_client = $role_client->id;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::where('rol_id',$this->role_client)->get();
        $type_list = 'cliente';
        $title='Lista de Clientes';
        return view('home')->with([
            'users'=>$users,
            'type_list' =>$type_list,
            'title'=>$title
        ]);
    }
    public function destroy($id)
    {
        $table = User::findOrFail($id);
        $table->delete();
        return redirect('/home');
    }
    public function show($id)
    {
        $user = User::find($id);
        $cargos = Cargo::all();
        $unidades = Unidad::all();
        $type_list = 'cliente';
        $title='Editar de Cliente';
        return view('pages.client.edit', [
            'user' => $user,
            "cargos"=>$cargos,
            "unidades"=>$unidades,
            'type_list' =>$type_list,
            'title'=>$title
        ]);
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $requestData = $request->all();
        $requestData['password'] = Hash::make($request->password);
        $user->update($requestData);
        return redirect()->route('users.show', $user->id);
    }
//HORARIOS----------------------------------------------------------------------------------
    public function list_horarios()
    {

        $horarios = Horario::all();
        $type_list = 'schedules';
        $title='Lista de Horarios';
        return view('pages.horarios.list')->with([
            'horarios'=>$horarios,
            'type_list' =>$type_list,
            'title'=>$title
        ]);
    }
    public function horarios_create(){
        $type_list = 'schedules';
        $title='Editar de Horario';
        return view('pages.horarios.create',
            [
                'type_list' =>$type_list,
                'title'=>$title
            ]
        );
    }
    public function horarios_store(Request $request)
    {
        $validatedData = $request->validate([
            'hora_entrada' => 'required',
            'hora_salida' => 'required',
            'nom_turno' => 'required',
            // Add validation rules for other fields here
        ]);
        Horario::create($validatedData);
        return redirect()->route('horario');
    }
    public function horario_show($id)
    {

        $horario = Horario::find($id);
        $type_list = 'schedules';
        $title='Editar de Horario';
        if($horario && $horario->hora_salida){
            $hora_salida= Carbon::createFromFormat('H:i:s', $horario->hora_salida);
            $horario->hora_salida = $hora_salida->format('G');
        }
        if($horario && $horario->hora_entrada){
            $hora_entrada= Carbon::createFromFormat('H:i:s', $horario->hora_entrada);
            $horario->hora_entrada = $hora_entrada->format('G');
        }
        $hours=["0","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23"];

        return view('pages.horarios.show', [
            'horario' => $horario,
            'type_list' =>$type_list,
            'title'=>$title,
            'hours'=>$hours
        ]);
    }
    public function horario_update(Request $request, $id)
    {
        $horario = Horario::findOrFail($id);
        $requestData = $request->all();
         $horario->update($requestData);
        return redirect()->route('horario.show', $horario->id);
    }
    public function horario_destroy($id)
    {
        $table = Horario::findOrFail($id);
        $table->delete();
        return redirect('/horarios');
    }
//EMPLOYEES----------------------------------------------------------------------------------
    public function list_employees()
    {
        $users = User::whereIn('rol_id',$this->role_employee_ids)->with('rol')->get();
        $type_list = 'employee';
        $title='Lista de Empleados';
        return view('pages.employees.list')->with([
            'users'=>$users,
            'type_list' =>$type_list,
            'title'=>$title
        ]);
    }
    public function employees_create(){
        $type_list = 'employee';
        $title='Crear Empleado';
        $cargos = Cargo::all();
        $unidades = Unidad::all();
        $roles= Rol::where('nom_role','!=','CLIENTE')->where('id','!=','1')->get();
        return view('pages.employees.create',[
            "cargos"=>$cargos,
            "unidades"=>$unidades,
            'type_list' =>$type_list,
            'title'=>$title,
            'roles'=>$roles
                ]
        );
    }
    public function employees_store(Request $request)
    {
        //$user = User::findOrFail($id);
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [ 'string', 'min:8', 'confirmed'],
            "ci"=>['min:5'],
            "celular"=>['min:7'],
        ]);
        $requestData = $request->all();
        $requestData['password'] = Hash::make($request->password);
        User::create($requestData);
        return redirect()->route('employee');
    }
    public function employee_show($id)
    {

        $user = User::find($id);
        $cargos = Cargo::all();
        $unidades = Unidad::all();
        $roles= Rol::where('nom_role','!=','CLIENTE')->where('id','!=','1')->get();
        $type_list = 'employee';
        $title='Editar de Empleado';
        return view('pages.employees.show', [
            "user" => $user,
            "cargos"=> $cargos,
            "unidades"=> $unidades,
            "type_list" => $type_list,
            "title"=> $title,
            "roles"=> $roles
        ]);
    }
    public function employee_update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $requestData = $request->all();
        $requestData['password'] = Hash::make($request->password);
        $user->update($requestData);
        return redirect()->route('employee.show', $user->id);
    }
    public function employee_destroy($id)
    {
        $table = User::findOrFail($id);
        $table->delete();
        return redirect('/employees');
    }

}
