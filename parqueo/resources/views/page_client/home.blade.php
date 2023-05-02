@extends('layouts.client')

@section('content-admin')
    <div class="w-100 px-3">
        <div class="row">
            <div class="col-3">
                <img class="img-fluid" src="{{asset('images/advertising.png')}}" alt="">
            </div>
            <div class="col-9">
                <div class="row pt-3">
                    <div class="col-7">
                        <img class="w-100" src="{{asset('images/photo_parqueo.svg')}}" alt="">
                    </div>
                    <div class="col-5">
                        <div class="d-flex justify-content-center mb-4">
                            <a href="" class="btn btn-danger bg-red-cherry me-3">Pagar</a>
                            <a href="" class="btn btn-danger bg-red-cherry">Lista recibos</a>
                        </div>
                        <div class="d-flex justify-content-center mb-4">
                            <a href="{{url('client/vehicle')}}" class="btn btn-danger bg-red-cherry me-3">Registrar vehiculo</a>
                            <a href="" class="btn btn-danger bg-red-cherry">Vehiculos registrados</a>
                        </div>
                        <div class="d-flex justify-content-center mb-4">
                            <a href="" class="btn btn-primary bg-blue-dark">Solicitud de parqueo</a>
                        </div>
                        <div class="d-flex justify-content-center mb-4">
                            <a href="" class="btn btn-primary bg-blue-dark">Reclamos</a>
                        </div>
                    </div>
                </div>
                <div class="row align-content-stretch">
                    @for ($i = 0; $i < 110; $i++)
                    <div class="col-1">
                        <a href=""> espacio {{ $i }}</a>
                    </div>
                    @endfor
                </div>

            </div>
        </div>
    </div>
@endsection
