@extends('layouts.admin')

@section('content-admin')
    <div class="container">
        <div class="w-100 px-3">
            <div class="row align-items-center justify-content-center pt-3">
                <div class="col-4">
                    <div>
                        <div class="mb-4">
                            <a href="{{url('/reports/users')}}" class="d-flex flex-column btn btn-secondary bg-blue-dark">Usuarios</a>
                        </div>
                        <div class="mb-4">
                            <a href="{{url('/reports/payments')}}" class="d-flex flex-column btn btn-secondary bg-blue-dark">Pagos</a>
                        </div>
                        <div class="mb-4">
                            <a href="{{url('/reports/announcement')}}" class="d-flex flex-column btn btn-secondary bg-blue-dark">Convocatoria</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
