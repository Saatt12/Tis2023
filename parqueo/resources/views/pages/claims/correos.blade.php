@extends('layouts.admin')

@section('content-admin')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center pt-5">
            <div class="col-md-7 col-lg-5">
                <div class="bg-red-cherry pt-3 pb-3 text-center fw-bolder text-white mb-2">Correos</div>
                <div class="card">
                    <div class="card-body">
                        {{--<form class="ps-3" method="POST" action="{{ route('messages_emails.store') }}">
                            @csrf
                            @method('PUT')--}}
                        <div class="ps-3 border-0">
                            <button type="button" onclick="selectedAll()" class="btn btn-primary bg-grey-light border-0 text-black"> Seleccionar todos</button>
                            @foreach($clients as $client)
                            <div class="row py-1">
                                <div class="col-10">
                                    <label for="check_{{$client->id}}" class="text-wrap">{{$client->email}}</label>
                                </div>
                                <div class="col-2">
                                    <input id="check_{{$client->id}}" type="checkbox" name="users[]" value="{{$client->id}}" class="form-check-input bg-grey-light checkbox-email">
                                </div>
                            </div>
                            @endforeach
                            <div class="row mb-5 mt-3 justify-content-center">
                                <div class="col-md-3"></div>


                                <div class="col-md-4 ">
                                    <a class="btn btn-primary bg-blue-dark" href="{{ url('/home') }}">
                                        Cancelar
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <button
                                        type="button"
                                        data-bs-toggle="modal"
                                        onclick="addDataChecks('receivers')"
                                        data-bs-target="#send-many-messages"
                                        class="btn btn-primary bg-blue-dark">
                                        Aceptar
                                    </button>
                                </div>
                            </div>
                        </div>
{{--                        </form>--}}
                    </div>
                </div>
            </div>
        </div>
        <x-generic-modal name="send-many-messages" title="Confirmar">
            <x-slot name="content" class="">
                <button type="button" class="btn btn-primary bg-grey-light border-0 text-black" data-bs-dismiss="modal"> Seleccionar Correos</button>
                <h5 class="py-1">Correos de reenvio de mensajes</h5>
                <div class="content-chat position-relative">
                    <div id="body-chat" class="chat-body d-block left-content-chat">
                    </div>
                    <div class="footer-chat position-absolute pe-3">
                        <hr class="m-0">
                        <form class="bg-white" action="{{route('messages_emails.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="bg-white w-100 py-2 d-flex">
                                <input autocomplete="off" name="message" type="text" class="bg-pick-chat rounded-pill px-3 flex-grow-1">
                                <input type="hidden" name="receivers" id="receivers">
                                {{--<label for="claim-file" class="bg-white">
                                    <img src="{{asset('images/upload_file.png')}}" alt="">
                                </label>
                                <input id="claim-file" type="file" name="file" class="visually-hidden">
                                --}}<button type="submit" class="btn-icon bg-white">
                                    <img src="{{asset('images/icon_send_message.png')}}" alt="">
                                </button>

                            </div>
                        </form>
                    </div>
                </div>
            </x-slot>
            <x-slot name="buttons" class=""></x-slot>
        </x-generic-modal>
    </div>
@endsection
@section('scripts')
    <script>
        const clients =  @json($clients);
        function selectedAll(){
            $('input[type="checkbox"]').prop('checked', true);
        }
        function addDataChecks(name='selected_checks'){
            let checked = []
            $("input[name='users[]']:checked").each(function ()
            {
                checked.push(parseInt($(this).val()));
            });
            const clients_selected = clients.filter(item=>checked.includes(item.id))
            const email_clients = clients_selected.map(
                item=> item.email?`<p class="text-start mb-0"> ${item.email}</p>`:''
            )
            $('#'+name).val(checked.join(','));
            $('#body-chat').html(email_clients.join(''));
        }
    </script>
@endsection
