@extends('layouts.app')
@section('content')
   {{-- <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">Navbar</a>
            <div class="navbar-collapse collapse" id="collapse">
                <div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                    </li>
                </ul>
                </div>
            </div>
        </div>
    </nav>--}}
   <div class="main-content-panel position-fixed h-100 w-100 d-flex">
       <nav class="navbar-content-fix bg-blue-dark-light h-100">
           <div>
               <div class="title-nav d-flex align-items-center justify-content-center">
                   {{auth()->user()->load(['cargo'])->cargo->nom_cargo}}
               </div>
               <hr>
           </div>
           <div>
               <ul class="list-unstyled ps-3">
                   <li>
                       <a class="text-dark text-decoration-none btn-item-nav btn"  href="" >Lista Clientes </a>
                   </li>
                   <li>
                       <a class="text-dark text-decoration-none btn-item-nav btn"  href="" >Solicitud Clientes </a>
                   </li>
                   <li>
                       <a class="text-dark text-decoration-none btn-item-nav btn"  href="" >Lista de Empleados </a>
                   </li>
                   <li>
                       <a class="text-dark text-decoration-none btn-item-nav btn"  href="" >Lista de Horarios </a>
                   </li>
               </ul>
           </div>
       </nav>
        @yield('content-admin')
   </div>
@endsection
