<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Unidad;
use App\Models\User;
use Illuminate\Http\Request;

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
        return view('home')->with([
            'users'=>$users,
            'type_list' =>$type_list
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
        return view('pages.client.edit', ['user' => $user,"cargos"=>$cargos,"unidades"=>$unidades]);
    }
    public function update(User $user, Request $request)
    {
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();
        $cargos = Cargo::all();
        $unidades = Unidad::all();
        return redirect()->route('users.show', $user->id)->with(['user' => $user,"cargos"=>$cargos,"unidades"=>$unidades]);
    }
}
