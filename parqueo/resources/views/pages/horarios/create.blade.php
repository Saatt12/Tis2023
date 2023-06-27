@extends('layouts.admin')

@section('content-admin')
    <div class="container">
        <div class="row justify-content-center pt-5">
            <div class="col-md-8 col-lg-7">
                <div class="bg-red-cherry pt-3 pb-3 text-center fw-bolder text-white mb-2">Formulario de Registro</div>
                <div class="card">
                    <div class="card-body">
                        <form class="ps-3" method="POST" action="{{ route('horario.store') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label">Crear Horario</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('nom_turno') is-invalid @enderror" name="nom_turno"
                                           value="{{old('nom_turno')}}" required autocomplete="name" autofocus>

                                    @error('nom_turno')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="horario_entrada" class="col-md-4 col-form-label">Horario Entrada</label>
                                <div class="col-md-6">
                                    <select id="horario_entrada" class="form-control @error('hora_entrada') is-invalid @enderror" name="hora_entrada" required autofocus>
                                        <option value="" selected> Selecciona una hora</option>
                                        @for ($i = 0; $i < 24; $i++)
                                            <option value="{{$i}}:00" {{ old('hora_entrada') == $i ? "selected" : "" }}>{{$i}}:00
                                                @if($i>=0 && $i<12)
                                                    AM
                                                @endif
                                                @if($i>=12 && $i<24)
                                                    PM
                                                @endif
                                            </option>
                                        @endfor
                                    </select>

                                    @error('hora_entrada')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="horario_salida" class="col-md-4 col-form-label">Horario Salida</label>
                                <div class="col-md-6">
                                     <select id="horario_salida" class="form-control @error('hora_salida') is-invalid @enderror" name="hora_salida" required autofocus>
                                        <option value="" selected> Selecciona una Hora</option>
                                        @for ($i = 0; $i < 24; $i++)
                                            <option value="{{$i}}:00" {{ old('hora_salida') == $i ? "selected" : "" }}>{{$i}}:00
                                                @if($i>=0 && $i<12)
                                                    AM
                                                @endif
                                                @if($i>=12 && $i<24)
                                                    PM
                                                @endif
                                            </option>
                                        @endfor
                                    </select>

                                    @error('hora_salida')
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
                                    <a class="btn btn-primary bg-blue-dark" href="{{ url('/horarios') }}">
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
