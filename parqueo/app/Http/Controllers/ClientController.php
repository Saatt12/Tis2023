<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Message;
use App\Models\Parking;
use App\Models\Payment;
use App\Models\RequestForm;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
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
        $title='PARQUEO UMSS';
        return view('page_client.home')->with([
            'type_list' =>$type_list,
            'title'=>$title,
            'vehicles'=>$vehicles,
            'payments'=>$payments,
            'parkings'=>$parkings
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
            $requestData['image'] = 'vehicles/'.$filename;
        }
        Vehicle::create($requestData);
        return redirect()->route('home_client');
    }
    public function payment_store(Request $request){
        $requestData = $request->all();
        $requestData["user_id"] = Auth::id();
        $payment = Payment::create($requestData);
        return response()->json($payment);
    }

    //REQUEST FORM
    public function request_form(Request $request){
        $user = Auth::user();
        $request_form = RequestForm::where('user_id',$user->id)->first();
        if(!$request_form){
            RequestForm::create([
                'user_id'=>$user->id
            ]);
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
}
