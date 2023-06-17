@extends('layouts.admin')

@section('content-admin')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="modal-content pt-3">
                    <div class=" bg-red-cherry text-pink-light justify-content-center py-2">
                        <h1 class="modal-title fs-5 text-center" id="vehicle_registered_Label">Lista Vehiculos
                        </h1>
                    </div>
                    <div class="pt-2">
                        <form action="{{route('search_vehicles')}}" method="POST" class="px-3">
                            @csrf
                            <input type="search" name="keyword" value="{{@$keyword}}">
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </form>
                        <div class="text-center">
                            <div class="row pt-2">
                                <div class="col-5 pb-2">
                                   <h5 class="text-blue-dark"> Placa</h5>
                                </div>
                                @if(@$user_permission->contains('horario_vehiculo'))
                                <div class="col-3">
                                    <h5 class="text-blue-dark">
                                    HrE - HrS
                                    </h5>
                                </div>
                                <div class="col-4 pb-2 d-flex">
                                </div>
                                @else
                                    <div class="col-7 pb-2 d-flex">
                                    </div>
                                @endif
                                @foreach ($vehicles as $key => $vehicle)
                                    <div class="col-5 pb-2">
                                       {{ $vehicle->placa }}
                                    </div>
                                    @if(@$user_permission->contains('horario_vehiculo'))
                                    <div class="col-3">
                                            {{@$vehicle->hour_vehicle->hora_entrada}} - {{@$vehicle->hour_vehicle->hora_salida}}
                                        </div>
                                    @endif
                                    @if(@$user_permission->contains('horario_vehiculo'))
                                        <div class="col-4 pb-2 d-flex">
                                            <a data-bs-toggle="modal"
                                               data-bs-target="#vehicle_hour_{{ $vehicle->id }}"
                                               class="btn btn-secondary bg-blue-dark">
                                                Registro Hora
                                            </a>
                                            <a href="" class="btn btn-secondary bg-blue-dark ms-2"
                                               data-bs-toggle="modal"
                                               data-bs-target="#vehicle_show_{{ $vehicle->id }}"> Ver </a>
                                        </div>
                                    @else
                                        <div class="col-7 pb-2 d-flex">
                                            <a href="" class="btn btn-secondary bg-blue-dark ms-2"
                                               data-bs-toggle="modal"
                                               data-bs-target="#vehicle_show_{{ $vehicle->id }}"> Ver </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-4">
                                    <a type="button" class="btn btn-secondary bg-blue-dark"
                                            href="{{url('/parking')}}">Cerrar</a>
                                </div>
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
                                        <label for="user" class="col-md-4 col-form-label">Propietario</label>

                                        <div class="col-md-6">
                                            <input id="user" type="text" class="form-control" readonly
                                                   value="{{ auth()->user()->name }}">
                                        </div>
                                    </div>
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

        <!-- Modal -->
        @foreach ($vehicles as $vehicle)
        <div class="modal fade" id="vehicle_hour_{{ $vehicle->id }}" data-bs-backdrop="static"
             data-bs-keyboard="false" tabindex="-1" aria-labelledby="vehicle_hour_Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content z-i-101">
                    <div class="modal-header bg-red-cherry text-pink-light justify-content-center">
                        <h1 class="modal-title fs-5 text-center" id="vehicle_hour_Label">Vehiculo</h1>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('hours_vehicle.store')}}" method="POST">
                            @csrf
                            <div class="row justify-content-center mt-4">
                            <div class="col-10">

                                        <input id="user" type="hidden" class="form-control" readonly
                                               value="{{ $vehicle->user_id }}" name="user_id">
                                        <input id="vehicle" type="hidden" class="form-control" readonly
                                               value="{{ $vehicle->id }}" name="vehicle_id">

                                <div class="row mb-3">
                                    <label for="hora_entrada" class="col-md-4 col-form-label"> Hora entrada</label>

                                    <div class="col-md-6">
                                        <input id="hora_entrada" type="time"
                                               class="form-control @error('hora_entrada') is-invalid @enderror" name="hora_entrada"
                                               value="" required autocomplete="name" autofocus>

                                        @error('hora_entrada')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="hora_salida" class="col-md-4 col-form-label"> Hora Salida</label>

                                    <div class="col-md-6">
                                        <input id="hora_salida" type="time"
                                               class="form-control @error('hora_salida') is-invalid @enderror" name="hora_salida"
                                               value="" required autocomplete="name" autofocus>

                                        @error('hora_salida')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-5 justify-content-center">
                                        <div class="col-4">
                                        <a class="btn btn-primary bg-blue-dark" data-bs-dismiss="modal">
                                            Cerrar
                                        </a>
                                        </div>
                                    <div class="col-4">
                                    <button type="submit" class="btn btn-primary bg-blue-dark">
                                           Aceptar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
{{--@section('scripts')
    <script>
    </script>
@endsection--}}
