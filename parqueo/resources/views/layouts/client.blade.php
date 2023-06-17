@extends('layouts.app')
@section('content')
    <div class="main-content-panel position-fixed h-100 w-100 d-flex general-container z-i-101">
        {{-- <nav class="navbar-content-fix bg-blue-dark-light h-100">
            <div>
                <div class="title-nav d-flex align-items-center justify-content-center">
                    {{auth()->user()->load(['cargo'])->cargo->nom_cargo}}
                </div>
                <hr>
            </div>
            <div>
                <ul class="list-unstyled ps-3">
                    <li>
                        <a
                            class="@if (@$type_list === 'cliente') active-item-nav @endif text-dark text-decoration-none btn-item-nav btn "
                            href="{{ url('/home') }}" >Lista Clientes </a>
                    </li>
                    <li>
                        <a

                            class="@if (@$type_list === 'request') active-item-nav @endif text-dark text-decoration-none btn-item-nav btn"
                            href="" >Solicitud Clientes </a>
                    </li>
                    <li>
                        <a
                            class="@if (@$type_list === 'employee') active-item-nav @endif text-dark text-decoration-none btn-item-nav btn"
                            href="" >Lista de Empleados </a>
                    </li>
                    <li>
                        <a
                            class="@if (@$type_list === 'schedules') active-item-nav @endif text-dark text-decoration-none btn-item-nav btn"
                            href="{{ url('/horarios') }}" >Lista de Horarios </a>
                    </li>
                </ul>
            </div>
        </nav> --}}
        <div class="w-100 overflow-auto">
            <div class="bg-blue-dark-light-2 d-flex justify-content-between py-3 px-3">
                <h4 class="text-pink-light">{{ @$title }}</h4>
                <div>
                    <div class="dropdown">
                        <button class="btn btn-primary bg-blue-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Notificaciones
                                <span class="bg-blue-dark-light-2 badge badge-light">
                                    {{$notifications && sizeof($notifications)>0?sizeof($notifications):0}}
                                </span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            @if($notifications && sizeof($notifications)>0)
                                @foreach($notifications as $notification)
                                    <li>
                                        <div class="text-center border border border-primary m-2">
                                            <h5>{{$notification->title}}</h5>
                                            <p class="m-0">
                                                {{$notification->content}}
                                            </p>
                                        </div>
                                    </li>
                                @endforeach
                            <li>
                                <form id="clear_notification" method="POST" action="{{ route('clear_notification') }}">
                                    @csrf
                                   <button type="submit" class="btn btn-danger small">Limpiar Notificaciones</button>
                                </form>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div>
                    <div class=" dropdown  item-avatar">
                        <div id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <div class="rounded-circle py-2 px-3 text-blue-dark bg-pink-light">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        </div>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @yield('content-admin')

        </div>
    </div>
@endsection
@section('scripts_news')
    @yield('scripts')
    <script>
        $("#clear_notification").validate({
            submitHandler: function(form) {
                let token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'POST',
                    url: $(form).attr('action'),
                    processData: false,
                    contentType: false,
                    enctype: 'multipart/form-data',
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    success: function(response) {
                        console.log("-> response", response);
                        /*$('#payment_mode_').modal('hide')
                        $('#success_payment_modal_').modal('show')*/
                        location.reload()
                    },
                    error: function(xhr, status, error) {
                        console.log("-> error", error);
                    }
                });
            }
        });
    </script>
@endsection
