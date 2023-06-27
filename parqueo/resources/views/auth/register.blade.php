@extends('layouts.app')

@section('content')
    <div class="content-register-all">
    </div>
    <div class="container general-container">
        <div class="row justify-content-center pt-5">
            <div class="col-md-7 col-lg-5">
                <div class="bg-red-cherry pt-3 pb-3 text-center fw-bolder text-white mb-2">Formulario de Registro</div>
                <div class="card">
                    <div class="card-body">
                        <form class="ps-3" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label">{{ 'Nombre' }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="ci" class="col-md-4 col-form-label">CI </label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('ci') is-invalid @enderror" name="ci"
                                        value="{{ old('ci') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="celular" class="col-md-4 col-form-label">Celular </label>
                                <div class="col-md-6">
                                    <input id="name" type="number"
                                        class="form-control @error('celular') is-invalid @enderror" name="celular"
                                        value="{{ old('celular') }}" required autocomplete="celular" autofocus>

                                    @error('celular')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="cargo" class="col-md-4 col-form-label">Cargo </label>
                                <div class="col-md-6">
                                    <select id="cargo" class="form-control @error('cargo_id') is-invalid @enderror"
                                        name="cargo_id" required autofocus>
                                        <option value="" selected> Selecciona un Cargo</option>
                                        @foreach ($cargos as $cargo)
                                            <option value="{{ $cargo->id }}">{{ $cargo->nom_cargo }}</option>
                                        @endforeach
                                    </select>

                                    @error('cargo_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label">{{ __('Email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label">Contraseña</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label">Confirmar contraseña</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="cargo" class="col-md-4 col-form-label">Unidad </label>
                                <div class="col-md-6">
                                    <select id="unidad" class="form-control @error('unidad_id') is-invalid @enderror"
                                        name="unidad_id" required autofocus>
                                        <option value="" selected> Selecciona una Unidad</option>
                                        @foreach ($unidades as $unidad)
                                            <option value="{{ $unidad->id }}">{{ $unidad->nom_unidad }}</option>
                                        @endforeach
                                    </select>

                                    @error('unidad_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-5 justify-content-center">
                                <div class="col-md-3"></div>

                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary bg-blue-dark">
                                        Aceptar
                                    </button>
                                </div>
                                <div class="col-md-4 ">
                                    <a class="btn btn-primary bg-blue-dark" href="{{ url('/') }}">
                                        Cancelar
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
