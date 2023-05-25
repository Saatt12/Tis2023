@extends('layouts.admin')

@section('content-admin')
    <div class="container">
        <div class="row justify-content-center pt-5">
            <div class="col-md-7 col-lg-5">
                <div class="bg-red-cherry pt-3 pb-3 text-center fw-bolder text-white mb-2">Convocatoria</div>
                <div class="card">
                    <div class="card-body">
                        <form class="ps-3" method="POST" action="{{ route('announcement.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="image" class="col-md-4 col-form-label"> Imagen</label>

                                <div class="col-md-6">
                                    <input id="image" type="file" accept="image/*"
                                           class="form-control @error('image') is-invalid @enderror" name="image"
                                           value="" required autocomplete="name" autofocus>

                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="fecha_inicio" class="col-md-4 col-form-label"> Fecha Inicio</label>

                                <div class="col-md-6">
                                    <input id="fecha_inicio" type="date"
                                           class="form-control @error('fecha_inicio') is-invalid @enderror" name="fecha_inicio"
                                           value="" required autocomplete="name" autofocus>

                                    @error('fecha_inicio')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="fecha_fin" class="col-md-4 col-form-label"> Fecha Fin</label>

                                <div class="col-md-6">
                                    <input id="fecha_fin" type="date"
                                           class="form-control @error('fecha_fin') is-invalid @enderror" name="fecha_fin"
                                           value="" required autocomplete="name" autofocus>

                                    @error('fecha_fin')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="descuento" class="col-md-4 col-form-label"> Descuento</label>

                                <div class="col-md-6">
                                    <select id="descuento" class="form-control @error('descuento') is-invalid @enderror" name="descuento"
                                            required autofocus>
                                        <option value="" selected> Selecciona un meses</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}"> {{ $i }}
                                                {{ $i == 1 ? 'mes' : 'meses' }} </option>
                                        @endfor
                                    </select>
                                    @error('descuento')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="multa" class="col-md-4 col-form-label"> Multa</label>

                                <div class="col-md-6">
                                    <select id="multa" class="form-control @error('multa') is-invalid @enderror" name="multa"
                                            required autofocus>
                                        <option value="" selected> Selecciona un meses</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}"> {{ $i }}
                                                {{ $i == 1 ? 'mes' : 'meses' }} </option>
                                        @endfor
                                    </select>
                                    @error('multa')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="monto_mes" class="col-md-4 col-form-label"> Monto Mes</label>

                                <div class="col-md-6">
                                    <input id="monto_mes" type="number"
                                           class="form-control @error('monto_mes') is-invalid @enderror" name="monto_mes"
                                           value="" required autocomplete="name" autofocus>

                                    @error('monto_mes')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="monto_multa" class="col-md-4 col-form-label"> Monto multa</label>

                                <div class="col-md-6">
                                    <input id="monto_multa" type="number"
                                           class="form-control @error('monto_multa') is-invalid @enderror" name="monto_multa"
                                           value="" required autocomplete="name" autofocus>

                                    @error('monto_multa')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="monto_descuento" class="col-md-4 col-form-label"> Monto Descuento</label>

                                <div class="col-md-6">
                                    <input id="monto_descuento" type="number"
                                           class="form-control @error('monto_descuento') is-invalid @enderror" name="monto_descuento"
                                           value="" required autocomplete="name" autofocus>

                                    @error('monto_descuento')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="monto_anual" class="col-md-4 col-form-label"> Monto Anual</label>

                                <div class="col-md-6">
                                    <input id="monto_anual" type="number"
                                           class="form-control @error('monto_anual') is-invalid @enderror" name="monto_anual"
                                           value="" required autocomplete="name" autofocus>

                                    @error('monto_anual')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="cantidad_espacios" class="col-md-4 col-form-label"> Cantidad Espacios</label>

                                <div class="col-md-6">
                                    <input id="cantidad_espacios" type="number"
                                           class="form-control @error('cantidad_espacios') is-invalid @enderror" name="cantidad_espacios"
                                           value="" required autocomplete="name" autofocus>

                                    @error('cantidad_espacios')
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
                                    <a class="btn btn-primary bg-blue-dark" href="{{ url('/parking') }}">
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
