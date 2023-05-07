<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Claim;
use App\Models\Horario;
use App\Models\Message;
use App\Models\Parking;
use App\Models\RequestForm;
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
//Requests ---------------------------------------------------
    public function list_requests(Request $request){
        $requests = [];
        $keyword = "";
        $type_list = 'request';
        $title='Solicitud Clientes';
        if($request && $request->keyword){
            $keyword=$request->keyword;
            $users_valid = User::where('name', 'ILIKE', '%' . $request->keyword . '%')->pluck('id');
            $requests = RequestForm::whereIn('user_id',$users_valid)->get();
        }else{
            $requests = RequestForm::all();
        }
        $parkings = Parking::all();
        return view('pages.requests.list')->with([
            'requests'=>$requests,
            'type_list' =>$type_list,
            'title'=>$title,
            'keyword' =>$keyword,
            'parkings' => $parkings
        ]);
    }
    public function assign_request(Request $request){
        $request_form_ids = explode(',',$request->request_ids);
        $request_valids = RequestForm::whereIn('id',$request_form_ids)->whereNull('parking_id')->pluck('id');
        $count_request = sizeof($request_valids);
        $count_parking_available = Parking::where('status','available')->count();
        if($count_request <= $count_parking_available){
            $random_parkings = Parking::where('status','available')->inRandomOrder()->take($count_request)->pluck('id');
            if($request_valids && sizeof($request_valids)>0){
                foreach ($request_valids as $index =>$item_request){
                    RequestForm::where('id', $item_request)->update([
                        'parking_id' => $random_parkings[$index],
                    ]);
                }
                Parking::whereIn('id',$random_parkings)->update(['status'=>'unavailable']);
            }
        }
        return redirect('/requests');
    }
    public function search_request(Request $request)
    {
        $keyword = $request->input('keyword');
        return redirect()->route('request',['keyword' => $keyword]);
    }
    public function remove_request(Request $request){
        $request_form_ids = explode(',',$request->request_ids);
        $request_list = RequestForm::whereIn('id',$request_form_ids)->get();
        foreach ($request_list as $request_form){
            if($request_form->parking_id){
                Parking::where('id',$request_form->parking_id)->update(['status'=>'available']);
            }
        }
        RequestForm::whereIn('id', $request_form_ids)->delete();
        $request->session()->flash('success', 'Se removieron correctamente las solicitudes');
        return redirect('/requests');
    }
    public function manual_request(Request $request){
        $request_form_id = $request->request_id;
        $request_form = RequestForm::where('id',$request_form_id)->first();
        $parking_id = $request->parking_id;
        if($request_form && $request_form->parking_id){
            Parking::where('id',$request_form->parking_id)->update(['status'=>'available']);
            if(@$parking_id){
                Parking::where('id',$parking_id)->update(['status'=>'unavailable']);
                RequestForm::where('id',$request_form_id)->update(['parking_id'=>$parking_id]);
            }else{
                RequestForm::where('id',$request_form_id)->update(['parking_id'=>null]);
            }
        }else{
            if(@$parking_id){
                Parking::where('id',$parking_id)->update(['status'=>'unavailable']);
                RequestForm::where('id',$request_form_id)->update(['parking_id'=>$parking_id]);
            }else{
                RequestForm::where('id',$request_form_id)->update(['parking_id'=>null]);
            }
        }
        $request->session()->flash('success', 'Se completo la Asignacion Manual');
        return redirect('/requests');
    }
    //Claims
    public function list_claims(){
        $type_list = 'claims';
        $title='Reclamos';
        $claims = Claim::all();
        return view('pages.claims.list')->with([
            'type_list' =>$type_list,
            'title'=>$title,
            'claims' => $claims
        ]);
    }
    public function claims_messages(Request $request){
        $type_list = 'claims';
        $title='Messages';
        $messages = Message::where('claim_id',$request->claim_id)->get();
        $claim = Claim::where('id',$request->claim_id)->first();
        return view('pages.claims.message')->with([
            'type_list' =>$type_list,
            'title'=>$title,
            'messages' => $messages,
            'claim' => $claim
        ]);
    }
    public function send_claim_message(Request $request){
        $user = Auth::user();
        $message = $request->message;
        $claim_id = $request->claim_id;
        $message_file = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Perform operations on the file, such as storing it, manipulating it, etc.

            //return "File uploaded successfully.";
        }
        if($message){
            $claim = Claim::where('id',$claim_id)->first();
            if($claim){
                $data_sms = [
                    'content'=> $message,
                    'type'=>'text',
                    'sender_id'=>$user->id,
                    'claim_id'=>$claim_id
                ];
                Message::create($data_sms);
            }
        }
        return redirect('/claims_messages/'.$claim_id);
    }
}
