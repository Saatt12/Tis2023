@extends('layouts.app')
@section('content')
    <div class="main-content-panel position-fixed h-100 w-100 d-flex general-container">
        <nav class="navbar-content-fix bg-blue-dark-light h-100 overflow-y-auto">
            <div>
                <div class="title-nav d-flex align-items-center justify-content-center">
                    {{ auth()->user()->load(['rol'])->rol->nom_role }}
                </div>
                <hr>
            </div>
            <div>

                <ul class="list-unstyled ps-3">

                    @if(@$user_permission->contains('ver_cargo'))
                        <li>
                            <a class="@if (@$type_list === 'cargos') active-item-nav @endif text-dark text-decoration-none btn-item-nav btn"
                               href="{{ url('/cargos') }}">Cargos </a>
                        </li>
                    @endif
                    @if(@$user_permission->contains('ver_unidad'))
                        <li>
                            <a class="@if (@$type_list === 'unidades') active-item-nav @endif text-dark text-decoration-none btn-item-nav btn"
                               href="{{ url('/unidades') }}">Unidades</a>
                        </li>
                        @endif
                    @if(@$user_permission->contains('ver_rol'))
                        <li>
                            <a class="@if (@$type_list === 'roles') active-item-nav @endif text-dark text-decoration-none btn-item-nav btn"
                               href="{{ url('/roles') }}">Roles </a>
                        </li>
                        @endif
                    @if(@$user_permission->contains('ver_clientes'))
                        <li>
                        <a class="@if (@$type_list === 'cliente') active-item-nav @endif text-dark text-decoration-none btn-item-nav btn "
                            href="{{ url('/home') }}">Lista Clientes </a>
                    </li>
                        @endif
                    @if(@$user_permission->contains('ver_solicitudes_parqueo'))
                    <li>
                        <a class="@if (@$type_list === 'request') active-item-nav @endif text-dark text-decoration-none btn-item-nav btn"
                            href="{{ url('/requests') }}">Solicitud Clientes </a>
                    </li>
                        @endif
                    @if(@$user_permission->contains('ver_empleado'))
                    <li>
                        <a class="@if (@$type_list === 'employee') active-item-nav @endif text-dark text-decoration-none btn-item-nav btn"
                            href="{{ url('/employees') }}">Lista de Empleados </a>
                    </li>
                        @endif
                    @if(@$user_permission->contains('ver_horario'))
                    <li>
                        <a class="@if (@$type_list === 'schedules') active-item-nav @endif text-dark text-decoration-none btn-item-nav btn"
                            href="{{ url('/horarios') }}">Lista de Horarios </a>
                    </li>
                        @endif
                    @if(@$user_permission->contains('ver_reclamo'))
                    <li>
                        <a class="@if (@$type_list === 'claims') active-item-nav @endif text-dark text-decoration-none btn-item-nav btn"
                           href="{{ url('/claims') }}">Reclamos</a>
                    </li>
                        @endif
                    @if(@$user_permission->contains('ver_parqueo'))
                    <li>
                        <a class="@if (@$type_list === 'parking') active-item-nav @endif text-dark text-decoration-none btn-item-nav btn"
                           href="{{ url('/parking') }}">Parquero</a>
                    </li>
                        @endif
                    @if(@$user_permission->contains('ver_reporte'))
                    <li>
                        <a class="@if (@$type_list === 'reports') active-item-nav @endif text-dark text-decoration-none btn-item-nav btn"
                           href="{{ url('/reports') }}">Reportes</a>
                    </li>
                        @endif
                    @if(@$user_permission->contains('ver_mensaje'))
                    <li>
                        <a class="@if (@$type_list === 'conversations') active-item-nav @endif text-dark text-decoration-none btn-item-nav btn"
                           href="{{ url('/conversations') }}">Mensajes</a>
                    </li>
                    @endif
                        <li>
                            <a class="@if (@$type_list === 'cobros') active-item-nav @endif text-dark text-decoration-none btn-item-nav btn"
                               href="{{ url('/cobros') }}">Cobros</a>
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
