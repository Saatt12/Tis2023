@extends('layouts.client')

@section('content-admin')
    <div class="w-100 px-3">
        <div class="row justify-content-center mt-4">
            <div class="col-8 col-md-6 col-lg-4">
                <div class="bg-red-cherry text-white py-3 mb-2">
                    <h3 class="text-center">Registrar Vehiculos</h3>
                </div>
                <form class="ps-3" method="POST" action="{{ route('vehicle.store') }}" enctype="multipart/form-data">
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
            </div>
        </div>
    </div>
@endsection
