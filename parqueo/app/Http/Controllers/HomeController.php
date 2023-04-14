<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Horario;
use App\Models\Unidad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
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
        return view('pages.horarios.create');
    }
}
