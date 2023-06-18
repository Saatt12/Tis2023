<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Claim;
use App\Models\Conversation;
use App\Models\ConversationMessage;
use App\Models\Message;
use App\Models\Notification;
use App\Models\Parking;
use App\Models\Payment;
use App\Models\RequestForm;
use App\Models\User;
use App\Models\Vehicle;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_auth= auth()->user();
        $vehicles = Vehicle::where('user_id',$user_auth->id)->get();
        $payments = Payment::where('user_id',$user_auth->id)->get();
        $parkings = Parking::all();

        $type_list = 'cliente';
        $news_messages = 0;
        $claim = Claim::where('client_id',$user_auth->id)->first();
        if($claim){
            $news_messages = Message::where('claim_id',$claim->id)
                    ->where('is_read',false)
                    ->where('sender_id','!=',$user_auth->id)
                    ->count();
        }
        $announcement = Announcement::whereDate('fecha_inicio', '<', Carbon::now())->whereDate('fecha_fin', '>', Carbon::now())->first();
        $my_request = null;
        $count_available_request = 0;
        if($announcement){
          $my_request = RequestForm::where('user_id',$user_auth->id)->where('announcement_id',$announcement->id)->whereNotNull('parking_id')->first();
          $requests = RequestForm::where('announcement_id',$announcement->id)->count();
            $count_available_request=$announcement->cantidad_espacios - $requests;
        }
        $notifications = Notification::where('user_id',$user_auth->id)->where('is_read',false)->get();



        $title='PARQUEO UMSS';
        return view('page_client.home')->with([
            'type_list' =>$type_list,
            'title'=>$title,
            'vehicles'=>$vehicles,
            'payments'=>$payments,
            'parkings'=>$parkings,
            'my_request'=>$my_request,
            'news_messages'=>$news_messages,
            'announcement' =>$announcement,
            'notifications' =>$notifications,
            'count_available_request'=>$count_available_request
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function vehicle_create()
    {
        return view('page_client.vehicles.create');
    }
    public function vehicle_store(Request $request)
    {
        $validatedData = $request->validate([
            'placa' => ['required', 'string', 'max:255'],
            'marca' => ['required', 'string', 'max:255'],
            'modelo' => ['required', 'string', 'max:255'],
            "image"=>['required'],
        ]);
        $requestData = $request->all();
        $requestData["user_id"] = Auth::id();
        $image = $request->file('image');
        if ($image) {
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/vehicles', $filename);
            $image->move('storage/vehicles', $filename);
            $requestData['image'] = 'vehicles/'.$filename;
        }
        Vehicle::create($requestData);
        return redirect()->route('home_client');
    }
    //PAYMENTS----------------------------------------------------
    public function payment_store(Request $request){
        $requestData = $request->all();
        $announcement = Announcement::whereDate('fecha_inicio', '<', Carbon::now())->whereDate('fecha_fin', '>', Carbon::now())->first();
        $requestData["user_id"] = Auth::id();
        $requestData["announcement_id"] = $announcement->id;
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
    public function export_payment_factura(Request $request){
        //dd($request);
        $data = Payment::findOrFail($request->payment_id);
        $cliente = "Luis Cabrera Benito";
        $remitente = "Luis Cabrera Benito";
        $web = "https://parzibyte.me/blog";
        $mensajePie = "Gracias por su compra";
        $numero = 1;
        $descuento = 0;
        $porcentajeImpuestos = 16;
        $productos = [
            [
                "precio" => 50,
                "descripcion" => "Procesador AMD Ryzen 7",
                "cantidad" => 1,
            ],
            [
                "precio" => 800,
                "descripcion" => "Tarjeta de vídeo",
                "cantidad" => 2,
            ],
        ];
        $fecha = date("Y-m-d");
        $view= view('page_client.template_export.factura')->with([
            'data'=>$data,
            'cliente'=>$cliente,
            'remitente'=>$remitente,
            'web'=>$web,
            'mensajePie'=>$mensajePie,
            'numero'=>$numero,
            'descuento'=>$descuento,
            'porcentajeImpuestos'=>$porcentajeImpuestos,
            'productos'=>$productos,
            'fecha'=>$fecha
        ]);;
        $options = new Options();
        $options->set('isRemoteEnabled',true);
        $dompdf = new Dompdf( $options );
        $dompdf->loadHtml($view);
        $dompdf->setPaper('letter', 'landscape');  // (Optional) Setup the paper size and orientation
        $dompdf->render();
        return $dompdf -> stream('Users'.'.pdf', ['Attachment' => false] );
        exit(0);
    }

    //REQUEST FORM
    public function request_form(Request $request){
        $user = Auth::user();
        $announcement = Announcement::whereDate('fecha_inicio', '<', Carbon::now())->whereDate('fecha_fin', '>', Carbon::now())->first();
        if(@$announcement){
            $request_form = RequestForm::where('user_id', $user->id)->first();
            $requests_forms_announcement = RequestForm::where('announcement_id', $announcement->id)->get();
            if(!$request_form && $announcement->cantidad_espacios>sizeof($requests_forms_announcement)) {
                RequestForm::create([
                    'user_id' => $user->id,
                    'announcement_id'=> $announcement->id
                ]);
            }
        }
        $request->session()->flash('success', 'Se envio la solicitud correctamente');
        return redirect('/client');
    }
    //CLAIMS
    public function claims(){
        $messages=[];
        $user = Auth::user();
        $claim = Claim::where('client_id',$user->id)->first();
        if($claim){
            Message::where('claim_id',$claim->id)->update(['is_read'=>true]);
            $messages = Message::where('claim_id',$claim->id)->get();
        }
        return view('page_client.claims.message')
            ->with([
                'messages'=> $messages
            ]);
    }
    public function claim_store(Request $request){
        $user = Auth::user();
        $message = $request->message;
        $message_file = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Perform operations on the file, such as storing it, manipulating it, etc.

            //return "File uploaded successfully.";
        }
        if($message){
            $claim = Claim::where('client_id',$user->id)->first();
            if(!$claim){
                $claim = Claim::create([
                   "client_id"=>$user->id
                ]);
            }
            $data_sms = [
                'content'=> $message,
                'type'=>'text',
                'sender_id'=>$user->id,
                'claim_id'=>$claim->id
            ];
            Message::create($data_sms);
        }
        return redirect()->route('claims.index');
    }
    //CONVERSATIONS
    public function list_conversations(){
        $type_list = 'conversations';
        $title='Mensajes';
        $conversations = Conversation::where('sender_id',Auth::id())->orWhere('receiver_id',Auth::id())->get();
        return view('page_client.messages.list')->with([
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
        return view('page_client.messages.message')->with([
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
        return redirect('/client/conversations_messages/'.$conversation_id);
    }
    public function conversation_emails(){
        $type_list = 'conversations';
        $title='Mensaje';
        $user = Auth::user();
        $users = User::where('id','!=' ,$user->id)->get();
        return view('page_client.messages.correos')->with([
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
        return redirect('/client/conversation_emails');
    }
    public function conversation_emails_remove(Request $request){
        $conversation_ids = explode(',',$request->conversation_ids);
        ConversationMessage::whereIn('conversation_id', $conversation_ids)->delete();
        Conversation::whereIn('id', $conversation_ids)->delete();
        return redirect('/conversations');
    }
    //Notifications
    public function clear_notification(){
       // dd(Auth::id());
        Notification::where('user_id',Auth::id())->where('is_read',false)->update(['is_read'=>true]);
        echo 'succesfully cleared';
    }
}
