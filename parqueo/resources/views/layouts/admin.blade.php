@extends('layouts.app')
@section('content')
    <div class="main-content-panel position-fixed h-100 w-100 d-flex general-container">
        <nav class="navbar-content-fix bg-blue-dark-light h-100">
            <div>
                <div class="title-nav d-flex align-items-center justify-content-center">
                    {{ auth()->user()->load(['rol'])->rol->nom_role }}
                </div>
                <hr>
            </div>
            <div>
                <ul class="list-unstyled ps-3">
                    <li>
                        <a class="@if (@$type_list === 'cliente') active-item-nav @endif text-dark text-decoration-none btn-item-nav btn "
                            href="{{ url('/home') }}">Lista Clientes </a>
                    </li>
                    <li>
                        <a class="@if (@$type_list === 'request') active-item-nav @endif text-dark text-decoration-none btn-item-nav btn"
                            href="{{ url('/requests') }}">Solicitud Clientes </a>
                    </li>
                    <li>
                        <a class="@if (@$type_list === 'employee') active-item-nav @endif text-dark text-decoration-none btn-item-nav btn"
                            href="{{ url('/employees') }}">Lista de Empleados </a>
                    </li>
                    <li>
                        <a class="@if (@$type_list === 'schedules') active-item-nav @endif text-dark text-decoration-none btn-item-nav btn"
                            href="{{ url('/horarios') }}">Lista de Horarios </a>
                    </li>
                    <li>
                        <a class="@if (@$type_list === 'claims') active-item-nav @endif text-dark text-decoration-none btn-item-nav btn"
                           href="{{ url('/claims') }}">Reclamos</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="w-100 overflow-auto">
            <div class="bg-blue-dark-light-2 d-flex justify-content-between py-3 px-3">
                <h4 class="text-pink-light">{{ @$title }}</h4>
                @yield('subhead-custom')
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
@endsection
