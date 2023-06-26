<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Cargo;
use App\Models\Claim;
use App\Models\Conversation;
use App\Models\ConversationMessage;
use App\Models\Horario;
use App\Models\IncomeVehicle;
use App\Models\Message;
use App\Models\Notification;
use App\Models\Parking;
use App\Models\Payment;
use App\Models\Permission;
use App\Models\RequestForm;
use App\Models\Rol;
use App\Models\RolePermission;
use App\Models\Unidad;
use App\Models\User;
use App\Models\Vehicle;
use App\Rules\ConvocatoriaDateRule;
use App\Rules\TimeHorarioRange;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Validation\Rule;
use PDF;

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
            'hora_entrada' => ['required',new TimeHorarioRange($request->hora_salida)],
            'hora_salida' => ['required',new TimeHorarioRange(null)],
            'nom_turno' => ['required',Rule::unique('horarios')],
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
    //CARGOS----------------------------------------------------------------------------------
    public function list_cargos()
    {
        $cargos = Cargo::all();
        $type_list = 'cargos';
        $title='Lista de Cargos';
        return view('pages.cargos.list')->with([
            'cargos'=>$cargos,
            'type_list' =>$type_list,
            'title'=>$title
        ]);
    }
    public function cargos_create(){
        $type_list = 'cargos';
        $title='Crear de Cargo';
        return view('pages.cargos.create',
            [
                'type_list' =>$type_list,
                'title'=>$title
            ]
        );
    }
    public function cargos_store(Request $request)
    {
        $validatedData = $request->validate([
            'nom_cargo' => 'required',
            // Add validation rules for other fields here
        ]);
        Cargo::create($validatedData);
        return redirect()->route('cargo');
    }
    public function cargo_show($id)
    {
        $cargo = Cargo::find($id);
        $type_list = 'cargos';
        $title='Editar de Cargo';
        return view('pages.cargos.show', [
            'cargo' => $cargo,
            'type_list' =>$type_list,
            'title'=>$title,
        ]);
    }
    public function cargo_update(Request $request, $id)
    {
        $cargo = Cargo::findOrFail($id);
        $requestData = $request->all();
        $cargo->update($requestData);
        return redirect('/cargos');
    }
    public function cargo_destroy($id)
    {
        $table = Cargo::findOrFail($id);
        $table->delete();
        return redirect('/cargos');
    }
    //ROLES----------------------------------------------------------------------------------
    public function list_roles()
    {
        $roles = Rol::where('id','!=',1)->get();
        $type_list = 'roles';
        $title='Lista de Roles';
        return view('pages.roles.list')->with([
            'roles'=>$roles,
            'type_list' =>$type_list,
            'title'=>$title
        ]);
    }
    public function roles_create(){
        $type_list = 'roles';
        $title='Crear de Rol';
        $permissions = Permission::all();
        return view('pages.roles.create',
            [
                'type_list' =>$type_list,
                'title'=>$title,
                'permissions'=>$permissions
            ]
        );
    }
    public function roles_store(Request $request)
    {
        $validatedData = $request->validate([
            'nom_role' => 'required',
            // Add validation rules for other fields here
        ]);
        $rol = Rol::create($validatedData);
        $data_admin_permission = [];
        if(@$request->permissions && sizeof($request->permissions)>0) {
            foreach ($request->permissions as $permission) {
                array_push($data_admin_permission, ['rol_id' => $rol->id, 'permission_id' => $permission]);
            }
            RolePermission::insert($data_admin_permission);
        }
        return redirect()->route('role');
    }
    public function role_show($id)
    {
        $role = Rol::find($id);
        $type_list = 'roles';
        $title='Editar de Rol';
        $permissions = Permission::all();
        $role_permissions = RolePermission::where('rol_id',$id)->pluck('permission_id');
        return view('pages.roles.show', [
            'role' => $role,
            'type_list' =>$type_list,
            'title'=>$title,
            'permissions'=>$permissions,
            'role_permissions'=>$role_permissions
        ]);
    }
    public function role_update(Request $request, $id)
    {
        $role = Rol::findOrFail($id);
        RolePermission::where('rol_id',$role->id)->delete();
        $data_admin_permission = [];
        if(@$request->permissions && sizeof($request->permissions)>0) {
            foreach ($request->permissions as $permission) {
                array_push($data_admin_permission, ['rol_id' => $role->id, 'permission_id' => $permission]);
            }
            RolePermission::insert($data_admin_permission);
        }
        $requestData = $request->except(['permissions']);
        $role->update($requestData);
        return redirect('/roles');
    }
    public function role_destroy($id)
    {
        $table = Rol::findOrFail($id);
        $table->delete();
        return redirect('/roles');
    }
    //UNIDADES----------------------------------------------------------------------------------
    public function list_unidades()
    {
        $unidades = Unidad::all();
        $type_list = 'unidades';
        $title='Lista de Unidades';
        return view('pages.unidades.list')->with([
            'unidades'=>$unidades,
            'type_list' =>$type_list,
            'title'=>$title
        ]);
    }
    public function unidades_create(){
        $type_list = 'unidades';
        $title='Crear de Unidad';
        return view('pages.unidades.create',
            [
                'type_list' =>$type_list,
                'title'=>$title
            ]
        );
    }
    public function unidades_store(Request $request)
    {
        $validatedData = $request->validate([
            'nom_unidad' => 'required',
            // Add validation rules for other fields here
        ]);
        Unidad::create($validatedData);
        return redirect()->route('unidad');
    }
    public function unidad_show($id)
    {
        $unidad = Unidad::find($id);
        $type_list = 'unidades';
        $title='Editar de Unidad';
        return view('pages.unidades.show', [
            'unidad' => $unidad,
            'type_list' =>$type_list,
            'title'=>$title,
        ]);
    }
    public function unidad_update(Request $request, $id)
    {
        $unidad = Unidad::findOrFail($id);
        $requestData = $request->all();
        $unidad->update($requestData);
        return redirect('/unidades');
    }
    public function unidad_destroy($id)
    {
        $table = Unidad::findOrFail($id);
        $table->delete();
        return redirect('/unidades');
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
                    $request_form =RequestForm::where('id', $item_request)->first();
                        Notification::create([
                        'user_id'=>$request_form->user_id,
                        'title'=>'Parqueo Asignado',
                        'content'=>'Ya puede realizar el pago en las distintas modalidades QR o de forma Manual'
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
            Notification::create([
                'user_id'=>$request_form->user_id,
                'title'=>'Parqueo Rechazado',
                'content'=>'Su solitud de parqueo fue anulada'
            ]);
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
                Notification::create([
                    'user_id'=>$request_form->user_id,
                    'title'=>'Parqueo Reasignado',
                    'content'=>'Se realizo un cambio en el parqeuo asignado'
                ]);
            }else{
                RequestForm::where('id',$request_form_id)->update(['parking_id'=>null]);
            }
        }else{
            if(@$parking_id){
                Parking::where('id',$parking_id)->update(['status'=>'unavailable']);
                RequestForm::where('id',$request_form_id)->update(['parking_id'=>$parking_id]);
                Notification::create([
                    'user_id'=>$request_form->user_id,
                    'title'=>'Parqueo Asignado',
                    'content'=>'Ya puede realizar el pago en las distintas modalidades QR o de forma Manual'
                ]);
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
    public function messages_emails(){
        $type_list = 'claims';
        $title='Messages';
        $clients = User::where('rol_id', $this->role_client)->get();
        return view('pages.claims.correos')->with([
            'type_list' =>$type_list,
            'title'=>$title,
            'clients' => $clients
        ]);
    }
    public function messages_emails_store(Request $request){
        $user = Auth::user();
        $receivers = explode(',',$request->receivers);
        if($request->message){
            foreach ($receivers as $client_id){
                $claim = Claim::where('client_id',$client_id)->first();
                if(!$claim){
                    $claim = Claim::create(['client_id'=>$client_id]);
                }
                $data_sms = [
                    'content'=> $request->message,
                    'type'=>'text',
                    'sender_id'=>$user->id,
                    'claim_id'=>$claim->id
                ];
                Message::create($data_sms);
            }
        }
        $request->session()->flash('success', 'Se envio correctamente el mensaje los clientes seleccionados');
        return redirect('/messages_emails');
    }
    public function messages_emails_remove(Request $request){
        $claim_ids = explode(',',$request->claim_ids);
        Message::whereIn('claim_id', $claim_ids)->delete();
        Claim::whereIn('id', $claim_ids)->delete();
        return redirect('/claims');
    }
    public function parking(){
        $type_list = 'parking';
        $title='Parquero';
        $parkings = Parking::all();
        $vehicles = Vehicle::all();
//        $clients = User::where('rol_id', $this->role_client)->get();
        return view('pages.parking.show')->with([
            'type_list' =>$type_list,
            'title'=>$title,
            'parkings'=>$parkings
//            'clients' => $clients
        ]);
    }
    public function vehicles(Request $request){
        $type_list = 'parking';
        $title='Parquero';
        $keyword='';
        $vehicles = [];
        if($request && $request->keyword){
            $keyword=$request->keyword;
            $vehicles = Vehicle::where('marca', 'ILIKE', '%' . $request->keyword . '%')
                ->orWhere('modelo', 'ILIKE', '%' . $request->keyword . '%')
                ->orWhere('placa', 'ILIKE', '%' . $request->keyword . '%')->get();
        }else{
            $vehicles = Vehicle::all();
        }
        return view('pages.parking.list_vehicles')->with([
            'type_list' =>$type_list,
            'title'=>$title,
            'keyword' =>$keyword,
            'vehicles'=>$vehicles
        ]);
    }
    public function search_vehicles(Request $request)
    {
        $keyword = $request->input('keyword');
        return redirect()->route('parking.vehicles',['keyword' => $keyword]);
    }

    //ANNOUNCEMENTS-----------------------------------------------------------------------
    public function list_announcements(){
        $type_list = 'parking';
        $title='Convocatoria';
        $announcement = Announcement::all();
        $current_announcement = Announcement::whereDate('fecha_inicio', '<', Carbon::now())->whereDate('fecha_fin', '>', Carbon::now())->first();
        return view('pages.parking.list_announcement')->with([
            'type_list' =>$type_list,
            'title'=>$title,
            'announcements' => $announcement,
            'current_announcement' => $current_announcement
        ]);
    }
    public function announcement_create(){
        $type_list = 'parking';
        $title='Convocatoria';
        return view('pages.announcements.create',[
                'type_list' =>$type_list,
                'title'=>$title,
            ]
        );

    }
    public function announcement_store(Request $request){
        $validatedData = $request->validate([
            'fecha_inicio'=>['required',new ConvocatoriaDateRule($request->fecha_fin)],
            'fecha_fin'=>['required',new ConvocatoriaDateRule(null)],
            'descuento'=>['required'],
            'multa'=>['required'],
            'monto_mes'=>['required'],
            'monto_multa'=>['required'],
            'monto_descuento'=>['required'],
            'monto_anual'=>['required'],
            'cantidad_espacios'=>['required'],
            'image'=>['required'],
            'file_announcement'=>['required']
        ]);
        $requestData = $request->all();
        $image = $request->file('image');
        if ($image) {
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/announcement', $filename);
            $image->move('storage/announcement', $filename);
            $requestData['image'] = 'announcement/'.$filename;
        }
        $file_announcement = $request->file('file_announcement');
        if ($file_announcement) {
            $filename = time() . '.' . $file_announcement->getClientOriginalExtension();
            $file_announcement->storeAs('public/announcement', $filename);
            $file_announcement->move('storage/announcement', $filename);
            $requestData['file_announcement'] = 'announcement/'.$filename;
        }
        Announcement::create($requestData);
        return redirect('/parking');
    }
    //CONVERSATIONS
    public function list_conversations(){
        $type_list = 'conversations';
        $title='Mensajes';
        $conversations = Conversation::where('sender_id',Auth::id())->orWhere('receiver_id',Auth::id())->get();
        return view('pages.conversations.list')->with([
            'type_list' =>$type_list,
            'title'=>$title,
            'conversations' => $conversations
        ]);
    }
    public function conversations_messages(Request $request){
        $type_list = 'conversations';
        $title='Mensajes';
        $messages = ConversationMessage::where('conversation_id',$request->conversation_id)->get();
        $conversation = Conversation::where('id',$request->conversation_id)->first();
        return view('pages.conversations.message')->with([
            'type_list' =>$type_list,
            'title'=>$title,
            'messages' => $messages,
            'conversation' => $conversation
        ]);
    }
    public function send_conversation_message(Request $request){
        $user = Auth::user();
        $message = $request->message;
        $conversation_id = $request->conversation_id;
        $message_file = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            // Perform operations on the file, such as storing it, manipulating it, etc.
            //return "File uploaded successfully.";
        }
        if($message){
            $conversation = Conversation::where('id',$conversation_id)->first();
            if($conversation){
                $data_sms = [
                    'message'=> $message,
                    'type'=>'text',
                    'sender_id'=>$user->id,
                    'receiver_id'=>$conversation->receiver_id===$user->id?$conversation->sender_id:$conversation->receiver_id,
                    'conversation_id'=>$conversation_id
                ];
                ConversationMessage::create($data_sms);
            }
        }
        return redirect('/conversations_messages/'.$conversation_id);
    }
    public function conversation_emails(){
        $type_list = 'conversations';
        $title='Mensaje';
        $user = Auth::user();
        $users = User::where('id','!=' ,$user->id)->get();
        return view('pages.conversations.correos')->with([
            'type_list' =>$type_list,
            'title'=>$title,
            'users' => $users
        ]);
    }
    public function conversation_emails_store(Request $request){
        $user = Auth::user();
        $receivers = explode(',',$request->receivers);
        if($request->message){
            foreach ($receivers as $receiver){
                $conversation = Conversation::where('receiver_id',$receiver)->orWhere('sender_id', $receiver)->first();
                if(!$conversation){
                    $conversation = Conversation::create(['receiver_id'=>$receiver,'sender_id'=>$user->id]);
                }
                $data_sms = [
                    'message'=> $request->message,
                    'type'=>'text',
                    'sender_id'=>$user->id,
                    'receiver_id'=>$receiver,
                    'conversation_id'=>$conversation->id
                ];
                ConversationMessage::create($data_sms);
            }
        }
        $request->session()->flash('success', 'Mensaje enviado exitosamente');
        return redirect('/conversation_emails');
    }
    public function conversation_emails_remove(Request $request){
        $conversation_ids = explode(',',$request->conversation_ids);
        ConversationMessage::whereIn('conversation_id', $conversation_ids)->delete();
        Conversation::whereIn('id', $conversation_ids)->delete();
        return redirect('/conversations');
    }
    //HOURS VEHICLES
    public function hours_vehicles_store(Request $request){
        $validatedData = $request->validate([
            'hora_entrada'=>['required'],
            'hora_salida'=>['required'],
            'vehicle_id'=>['required'],
            'user_id'=>['required'],
        ]);
        $requestData = $request->all();
        $income_vehicle = IncomeVehicle::where('vehicle_id',$request->vehicle_id)->whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))->first();
        if(!$income_vehicle){
            $income_vehicle = IncomeVehicle::create($requestData);
            $income_vehicle = IncomeVehicle::findOrFail($income_vehicle->id);
        }else{
            $income_vehicle->update($requestData);
        }
        Vehicle::where('id',$request->vehicle_id)->update(['hour_vehicle_id'=>$income_vehicle->id]);
        $keyword = $request->input('keyword');
        return redirect()->route('parking.vehicles',['keyword' => $keyword]);
    }
    //REPORTS
    public function reports(){
        $type_list = 'reports';
        $title='Reporte';
        return view('pages.reports.reports')->with([
            'type_list' =>$type_list,
            'title'=>$title,
        ]);
    }
    public function reports_users(Request $request){
        $users = User::where('rol_id','!=',1);
        $type_list = 'reports';
        $title='Reportes Usuarios';
        $announcements = Announcement::all();
        $announcement_id='';
        $date_initial='';
        $date_fin='';
        $name='';
        if($request && @$request->announcement_id){
            $users_request = RequestForm::where('announcement_id',$request->announcement_id)->pluck('user_id');
           $users = $users->whereIn('id',$users_request);
            $announcement_id = $request->announcement_id;
        }
        if($request && @$request->date_initial){
            $users = $users->whereDate('created_at', '>=', $request->date_initial);
            $date_initial = $request->date_initial;
        }
        if($request && @$request->date_fin){
            $users = $users->whereDate('created_at', '<=', $request->date_fin);
            $date_fin =$request->date_fin;
        }
        if($request && @$request->name){
            $users = $users->where('name', 'ILIKE', '%' . $request->name . '%');
            $name =$request->name;
        }
        $users = $users->get();
        if(sizeof($request->all()) === 0) $users = [];
        return view('pages.reports.reports_users')->with([
            'users'=>$users,
            'type_list' =>$type_list,
            'title'=>$title,
            'announcements'=>$announcements,
            'announcement_id' =>$announcement_id,
            'date_initial' =>$date_initial,
            'date_fin' =>$date_fin,
            'name' =>$name,
        ]);
    }
    public function reports_payments(Request $request){
        $type_list = 'reports';
        $title='Reportes Pagos';
        $search = $request->all();
        $date_initial='';
        $date_fin='';
        $name='';

        if(sizeof($search)){
            $payments = Payment::where('id','!=',null);
            if($request && @$request->date_initial){
                $payments = $payments->whereDate('created_at', '>=', $request->date_initial);
                $date_initial = $request->date_initial;
            }
            if($request && @$request->date_fin){
                $payments = $payments->whereDate('created_at', '<=', $request->date_fin);
                $date_fin =$request->date_fin;
            }
            if($request && @$request->name){
                $user_ids = User::where('name', 'ILIKE', '%' . $request->name . '%')->pluck('id');
                $payments = $payments->whereIn('user_id',$user_ids);
                $name =$request->name;
            }
            $payments = $payments->get();
            if(sizeof($request->all()) === 0) $payments = [];
            return view('pages.reports.reports_payments')->with([
                'payments'=>$payments,
                'type_list' =>$type_list,
                'title'=>$title,
                'date_initial' =>$date_initial,
                'date_fin' =>$date_fin,
                'name' =>$name,
            ]);
        }else{
            $payments_all = Payment::all();
            if(sizeof($request->all()) === 0) $payments_all = [];
            return view('pages.reports.reports_payments')->with([
                'payments'=>$payments_all,
                'type_list' =>$type_list,
                'title'=>$title,
                'date_initial' =>$date_initial,
                'date_fin' =>$date_fin,
                'name' =>$name,
            ]);
        }

    }
    public function reports_announcement(Request $request){
        $type_list = 'reports';
        $title='Reportes Convocatorias';
        $date_initial='';
        $date_fin='';
        $announcements = Announcement::where('id','!=',null);
        if($request && @$request->date_initial){
            $announcements = $announcements->whereDate('created_at', '>=', $request->date_initial);
            $date_initial = $request->date_initial;
        }
        if($request && @$request->date_fin){
            $announcements = $announcements->whereDate('created_at', '<=', $request->date_fin);
            $date_fin =$request->date_fin;
        }
        $announcements = $announcements->get();
        if(sizeof($request->all()) === 0) $announcements = [];
        return view('pages.reports.reports_announcement')->with([
            'type_list' =>$type_list,
            'title'=>$title,
            'announcements'=>$announcements,
            'date_initial' =>$date_initial,
            'date_fin' =>$date_fin,
        ]);
    }
    public function export_reports_users(Request $request){
        $users = User::where('rol_id','!=',1);
        $type_list = 'reports';
        $title='Reportes Usuarios';
        $announcements = Announcement::all();

        $announcement_id='';
        $date_initial='';
        $date_fin='';
        $name='';
        if($request && @$request->announcement_id){
            $users_request = RequestForm::where('announcement_id',$request->announcement_id)->pluck('user_id');
            $users = $users->whereIn('id',$users_request);
            $announcement_id = $request->announcement_id;
        }
        if($request && @$request->date_initial){
            $users = $users->whereDate('created_at', '>=', $request->date_initial);
            $date_initial = $request->date_initial;
        }
        if($request && @$request->date_fin){
            $users = $users->whereDate('created_at', '>=', $request->date_fin);
            $date_fin =$request->date_fin;
        }
        if($request && @$request->name){
            $users = $users->where('name', 'ILIKE', '%' . $request->name . '%');
            $name =$request->name;
        }

            $data = $users->get();
            $view= view('pages.template_export.pdf_generic')->with([
                'data'=>$data,
            ]);;
            $options = new Options();
            $options->set('isRemoteEnabled',true);
            $dompdf = new Dompdf( $options );
            $dompdf->loadHtml($view);
            $dompdf->setPaper('A4', 'landscape');  // (Optional) Setup the paper size and orientation
            $dompdf->render();
            return $dompdf -> stream ('Users'.'.pdf', ['Attachment' => false] );
            exit(0);
    }
    public function export_reports_payments(Request $request){
        $payments = Payment::where('id','!=',null);
        $type_list = 'reports';
        $title='Reportes Pagos';
        if($request && @$request->date_initial){
            $payments = $payments->whereDate('created_at', '>=', $request->date_initial);
            $date_initial = $request->date_initial;
        }
        if($request && @$request->date_fin){
            $payments = $payments->whereDate('created_at', '<=', $request->date_fin);
            $date_fin =$request->date_fin;
        }
        if($request && @$request->name){
            $user_ids = User::where('name', 'ILIKE', '%' . $request->name . '%')->pluck('id');
            $payments = $payments->whereIn('user_id',$user_ids);
            $name =$request->name;
        }
         $data = $payments->get();
        $view= view('pages.template_export.pdf_payments')->with([
            'data'=>$data,
        ]);;
        $options = new Options();
        $options->set('isRemoteEnabled',true);
        $dompdf = new Dompdf( $options );
        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'landscape');  // (Optional) Setup the paper size and orientation
        $dompdf->render();
        return $dompdf -> stream ('Users'.'.pdf', ['Attachment' => false] );
        exit(0);
    }
    public static function getImage(string $url)
    {
        $path = base_path($url);

        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }
    public function export_reports_announcement(Request $request){
        $users = User::where('rol_id','!=',1);
        $type_list = 'reports';
        $title='Reportes Usuarios';
        $announcements = Announcement::where('id','!=',null);
        if($request && @$request->date_initial){
            $announcements = $announcements->whereDate('created_at', '>=', $request->date_initial);
            $date_initial = $request->date_initial;
        }
        if($request && @$request->date_fin){
            $announcements = $announcements->whereDate('created_at', '<=', $request->date_fin);
            $date_fin =$request->date_fin;
        }
        $list=$announcements->get();
        foreach ($list as $item){
            $item->image =self::getImage('public/storage/'.$item->image);
        }
        $data = $list;
        $view= view('pages.template_export.pdf_announcements')->with([
            'data'=>$data,
        ]);;
        $options = new Options();
        $options->set('isRemoteEnabled',true);
        $dompdf = new Dompdf( $options );
        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'landscape');  // (Optional) Setup the paper size and orientation
        $dompdf->render();
        return $dompdf -> stream ('Users'.'.pdf', ['Attachment' => false] );
        exit(0);
    }

    public function search_reports_users(Request $request){
        $validatedData = $request->validate([
            'announcement_id' => ['required'],
            'date_initial' => ['required'],
            'date_fin' => ['required'],
            'name' => ['required'],
        ]);
        $search = $request->except('_token');
        return redirect()->route('reports_users',$search);

    }
    public function search_reports_payments(Request $request){
        $validatedData = $request->validate([
            'date_initial' => ['required'],
            'date_fin' => ['required'],
            'name' => ['required'],
        ]);
        $search = $request->except('_token');
        return redirect()->route('reports_payments',$search);
    }
    public function search_reports_announcement(Request $request){
        $validatedData = $request->validate([
            'date_initial' => ['required'],
            'date_fin' => ['required'],
        ]);
        $search = $request->except('_token');
        return redirect()->route('reports_announcement',$search);
    }
    //COBROS----------------------------------------------------------------------------------
    public function list_cobros(Request $request)
    {
        $type_list = 'cobros';
        $title='Pagos Parqueo';
        $search = $request->all();
        $date_initial='';
        $date_fin='';
        $name='';
        $announcement = Announcement::whereDate('fecha_inicio', '<', Carbon::now())->whereDate('fecha_fin', '>', Carbon::now())->first();
        $requests = [];
        if($announcement){
            $requests = RequestForm::where('announcement_id',$announcement->id)->whereNotNull('parking_id')->get();
        }
        if(sizeof($search)){
            $payments = Payment::where('id','!=',null);
            if($request && @$request->date_initial){
                $payments = $payments->whereDate('created_at', '>=', $request->date_initial);
                $date_initial = $request->date_initial;
            }
            if($request && @$request->date_fin){
                $payments = $payments->whereDate('created_at', '<=', $request->date_fin);
                $date_fin =$request->date_fin;
            }
            if($request && @$request->name){
                $user_ids = User::where('name', 'ILIKE', '%' . $request->name . '%')->pluck('id');
                $payments = $payments->whereIn('user_id',$user_ids);
                $name =$request->name;
            }
            $payments = $payments->get();
            return view('pages.cobros.list')->with([
                'payments'=>$payments,
                'type_list' =>$type_list,
                'title'=>$title,
                'date_initial' =>$date_initial,
                'date_fin' =>$date_fin,
                'name' =>$name,
                'announcement'=>$announcement,
                "requests"=>$requests
            ]);
        }else{
            $payments_all = Payment::all();
            return view('pages.cobros.list')->with([
                'payments'=>$payments_all,
                'type_list' =>$type_list,
                'title'=>$title,
                'date_initial' =>$date_initial,
                'date_fin' =>$date_fin,
                'name' =>$name,
                'announcement'=>$announcement,
                "requests"=>$requests
            ]);
        }
    }
    public function cobros_verified(Request $request){
        $payment = Payment::findOrFail($request->payment_id);
        $payment->status = 'Pagado';
        $payment->save();
        return redirect('/cobros');
    }
    public function cobros_store(Request $request)
    {
        $requestData = $request->all();
        $announcement = Announcement::whereDate('fecha_inicio', '<', Carbon::now())->whereDate('fecha_fin', '>', Carbon::now())->first();
        $requestData["announcement_id"] = $announcement->id;
        $requestData["status"] = 'Pagado';
        $comprobante = $request->file('comprobante');
        if ($comprobante) {
            $filename = time() . '.' . $comprobante->getClientOriginalExtension();
            $comprobante->storeAs('public/comprobante', $filename);
            $comprobante->move('storage/comprobante', $filename);
            $requestData['comprobante'] = 'comprobante/'.$filename;
        }
        $payment = Payment::create($requestData);
        return response()->json($payment);
    }
    public function search_cobros_payments(Request $request){
        $search = $request->except('_token');
        return redirect()->route('cobros',$search);
    }
    /*public function cobro_destroy($id)
    {
        $table = Payment::findOrFail($id);
        $table->delete();
        return redirect('/cobros');
    }*/
}
