@extends('layouts.client')

@section('content-admin')
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-8 col-md-8 col-lg-7">
                <div class="bg-red-cherry text-white py-3">
                    <h4 class="text-center mb-0">Chat</h4>
                </div>
                <div class="content-chat position-relative">
                    <div class="chat-body">
                        @foreach($messages as $message)
                            @if($message->sender_id === auth()->id())
                            <div class="right-content-chat my-2">
                                <div class="content-message p-3">
                                    {{$message->content}}
                                 </div>
                            </div>
                            @else
                            <div class="left-content-chat my-2">
                                <div class="content-message p-3">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.asdkasndkasnkdn
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="footer-chat position-absolute pe-3">
                        <hr class="m-0">
                        <form class="bg-white" action="{{route('claim.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="bg-white w-100 py-2 d-flex">
                                <input autocomplete="off" name="message" type="text" class="bg-pick-chat rounded-pill px-3 flex-grow-1">
                                <label for="message-file" class="bg-white">
                                    <img src="{{asset('images/upload_file.png')}}" alt="">
                                </label>
                                <input id="message-file" type="file" name="file" class="visually-hidden">
                                <button type="submit" class="btn-icon bg-white">
                                    <img src="{{asset('images/icon_send_message.png')}}" alt="">
                                </button>

                            </div>
                            <div class="row justify-content-center ">
                                <div class="col-4">
                                    <a href="{{url('/client')}}" class="btn btn-primary bg-blue-dark"> Cerrar </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
               {{-- <form class="ps-3" method="POST" action="{{ route('vehicle.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="user"
                               class="col-md-4 col-form-label">Propietario</label>

                        <div class="col-md-6">
                            <input id="user" type="text"
                                   class="form-control" readonly
                                   value="{{auth()->user()->name}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label">Placa</label>

                        <div class="col-md-6">
                            <input id="placa" type="text"
                                   class="form-control @error('placa') is-invalid @enderror" name="placa"
                                   value="" required autocomplete="name" autofocus>

                            @error('placa')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="marca" class="col-md-4 col-form-label">Marca</label>

                        <div class="col-md-6">
                            <input id="marca" type="text"
                                   class="form-control @error('marca') is-invalid @enderror" name="marca"
                                   value="" required autocomplete="name" autofocus>

                            @error('marca')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="modelo" class="col-md-4 col-form-label">Modelo</label>

                        <div class="col-md-6">
                            <input id="modelo" type="text"
                                   class="form-control @error('modelo') is-invalid @enderror" name="modelo"
                                   value="" required autocomplete="name" autofocus>

                            @error('modelo')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="image"
                               class="col-md-4 col-form-label">Foto</label>

                        <div class="col-md-6">
                            <input id="image" type="file" accept="image/*"
                                   class="form-control @error('image') is-invalid @enderror" name="image"
                                   value="" required autocomplete="image">

                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-5 justify-content-center">
                        <div class="col-12 col-sm-4">
                            <button type="submit" class="btn btn-primary bg-blue-dark">
                                Aceptar
                            </button>
                        </div>
                        <div class="col-12 col-sm-4">
                            <a class="btn btn-primary bg-blue-dark" href="{{ url('/client') }}">
                                Cancelar
                            </a>
                        </div>
                    </div>
                </form>
            --}}
            </div>
        </div>
    </div>
@endsection
