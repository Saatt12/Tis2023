@extends('layouts.admin')

@section('content-admin')
    <div class="container">
        <div class="row justify-content-center pt-5">
            <div class="col-md-8 col-lg-7">
                <div class="bg-red-cherry pt-3 pb-3 text-center fw-bolder text-white mb-2">Editar Horario</div>
                <div class="card">
                    <div class="card-body">
                        <form class="ps-3" method="POST" action="{{ route('horario.update', $horario->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label">Nombre Horario</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('nom_turno') is-invalid @enderror" name="nom_turno"
                                           value="{{@$horario->nom_turno}}" required autocomplete="name" autofocus>

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
                                        <option value="" > Selecciona una hora</option>
                                        @foreach($hours as $hour)
                                            <option
                                                value="{{$hour}}:00"
                                                {{ $horario->hora_entrada == $hour ? 'selected' : '' }}
                                            >
                                                {{$hour}}:00
                                                @if($hour>=0 && $hour<12)
                                                    AM
                                                @endif
                                                @if($hour>=12 && $hour<24)
                                                    PM
                                                @endif
                                            </option>
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
                                <label for="horario_salida" class="col-md-4 col-form-label">Horario Salida</label>
                                <div class="col-md-6">
                                    <select id="horario_salida" class="form-control @error('hora_salida') is-invalid @enderror" name="hora_salida" required autofocus>
                                        <option value=""  selected="{{!@$horario->hora_salida?'selected':''}}"> Selecciona una Hora</option>
                                        @foreach($hours as $hour)
                                            <option
                                                value="{{$hour}}:00"
                                        {{ $horario->hora_salida == $hour ? 'selected' : '' }}
                                        >
                                        {{$hour}}:00
                                        @if($hour>=0 && $hour<12)
                                            AM
                                        @endif
                                        @if($hour>=12 && $hour<24)
                                            PM
                                            @endif
                                            </option>
                                            @endforeach
                                    </select>

                                    @error('cargo_id')
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
