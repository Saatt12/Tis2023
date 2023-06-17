@extends('layouts.admin')

@section('content-admin')
    <div class="container">
        <div class="w-100 px-3">
            <div class="row align-items-center justify-content-center pt-3">
                <div class="col-4">
                    <div>
                        <div class="mb-4">
                            @if(@$user_permission->contains('ver_reporte_usuario'))
                            <a href="{{url('/reports/users')}}" class="d-flex flex-column btn btn-secondary bg-blue-dark">Usuarios</a>
                            @endif
                        </div>
                        <div class="mb-4">
                            @if(@$user_permission->contains('ver_reporte_pagos'))
                            <a href="{{url('/reports/payments')}}" class="d-flex flex-column btn btn-secondary bg-blue-dark">Pagos</a>
                            @endif
                        </div>
                        <div class="mb-4">
                            @if(@$user_permission->contains('ver_reporte_convocatoria'))
                            <a href="{{url('/reports/announcement')}}" class="d-flex flex-column btn btn-secondary bg-blue-dark">Convocatoria</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
