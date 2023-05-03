@extends('layouts.client')

@section('content-admin')
    <div class="w-100 px-3">
        <div class="row">
            <div class="col-3">
                <img class="img-fluid" src="{{ asset('images/advertising.png') }}" alt="">
            </div>
            <div class="col-9">
                <div class="row pt-3">
                    <div class="col-7">
                        <img class="w-100" src="{{ asset('images/photo_parqueo.svg') }}" alt="">
                    </div>
                    <div class="col-5">
                        <div class="d-flex justify-content-center mb-4">
                            <a href="" class="btn btn-danger bg-red-cherry me-3">Pagar</a>
                            <a href="" class="btn btn-danger bg-red-cherry">Lista recibos</a>
                        </div>
                        <div class="d-flex justify-content-center mb-4">
                            <a href="{{ url('client/vehicle') }}" class="btn btn-danger bg-red-cherry me-3">Registrar
                                vehiculo</a>
                            <a href="" class="btn btn-danger bg-red-cherry" data-bs-toggle="modal"
                                data-bs-target="#vehicle_registered_">Vehiculos registrados</a>
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
                <!-- Modal -->
                <div class="modal fade" id="vehicle_registered_" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="vehicle_registered_Label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-red-cherry text-pink-light justify-content-center">
                                <h1 class="modal-title fs-5 text-center" id="vehicle_registered_Label">Vehiculos registrados
                                </h1>
                            </div>
                            <div class="modal-body">
                                <div class="text-center">
                                    <div class="row">
                                        @foreach ($vehicles as $key => $vehicle)
                                            <div class="col-7 pb-2">
                                                {{ $vehicle->marca }} {{ $vehicle->placa }}
                                            </div>
                                            <div class="col-5 pb-2">
                                                <a href="" class="btn btn-secondary bg-blue-dark"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#vehicle_show_{{ $vehicle->id }}"> Ver </a>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-4">
                                            <button type="button" class="btn btn-secondary bg-blue-dark"
                                                data-bs-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Modal -->
                @foreach ($vehicles as $vehicle)
                    <div class="modal fade" id="vehicle_show_{{ $vehicle->id }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="vehicle_show_Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content z-i-101">
                                <div class="modal-header bg-red-cherry text-pink-light justify-content-center">
                                    <h1 class="modal-title fs-5 text-center" id="vehicle_show_Label">Vehiculo</h1>
                                </div>
                                <div class="modal-body">
                                    <div class="row justify-content-center mt-4">
                                        <div class="col-10">
                                            <div class="row mb-3">
                                                <label for="name" class="col-md-4 col-form-label">Placa</label>

                                                <div class="col-md-6">
                                                    <input id="placa" type="text" readonly class="form-control"
                                                        name="placa" value="{{ $vehicle->placa }}" required
                                                        autocomplete="name" autofocus>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="marca" class="col-md-4 col-form-label">Marca</label>

                                                <div class="col-md-6">
                                                    <input id="marca" type="text" readonly class="form-control"
                                                        name="marca" value="{{ $vehicle->marca }}" required
                                                        autocomplete="name" autofocus>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="modelo" class="col-md-4 col-form-label">Modelo</label>

                                                <div class="col-md-6">
                                                    <input id="modelo" type="text" readonly class="form-control"
                                                        name="modelo" value="{{ $vehicle->modelo }}" required
                                                        autocomplete="name" autofocus>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="image" class="col-md-4 col-form-label">Foto</label>

                                                <div class="col-md-6">
                                                    <img class="img-fluid" id="image"
                                                        src="{{ asset('storage/' . $vehicle->image) }}" alt="">
                                                </div>
                                            </div>
                                            <div class="row mb-5 justify-content-center">
                                                <div class="col-12 col-sm-4">
                                                    <a class="btn btn-primary bg-blue-dark" data-bs-dismiss="modal">
                                                        Cerrar
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script></script>
@endsection
