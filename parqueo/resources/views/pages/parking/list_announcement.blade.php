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
                        <h1 class="modal-title fs-5 text-center" id="vehicle_registered_Label">Convocatorias
                        </h1>
                    </div>
                    <div class="pt-2">
                        <div class="text-center">
                            @foreach ($announcements as $key => $announcement)
                            <div class="row w-100 mx-0 p-1 {{@$current_announcement && $current_announcement->id===$announcement->id?'bg-grey-light':''}}">
                                    <div class="col-7 pb-2">
                                       Convocatoria {{ $announcement->fecha_inicio }} | {{ $announcement->fecha_fin }}
                                        @if(@$current_announcement && $current_announcement->id===$announcement->id)
                                        <strong> (Vigente)</strong>
                                        @endif
                                    </div>
                                    <div class="col-5 pb-2">
                                        <a href="" class="btn btn-secondary bg-blue-dark"
                                           data-bs-toggle="modal"
                                           data-bs-target="#vehicle_show_{{ $announcement->id }}"> Ver </a>
                                    </div>

                            </div>
                            @endforeach
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
        @foreach ($announcements as $announcement)
            <div class="modal fade" id="vehicle_show_{{ $announcement->id }}" data-bs-backdrop="static"
                 data-bs-keyboard="false" tabindex="-1" aria-labelledby="vehicle_show_Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content z-i-101">
                        <div class="modal-header bg-red-cherry text-pink-light justify-content-center">
                            <h1 class="modal-title fs-5 text-center" id="vehicle_show_Label">Convocatoria</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row justify-content-center mt-4">
                                <div class="col-10">
                                    <div class="row mb-3">
                                        <label for="fecha_inicio" class="col-md-4 col-form-label"> Fecha Inicio</label>

                                        <div class="col-md-6">
                                            <input readonly id="fecha_inicio" type="date"
                                                   class="form-control @error('fecha_inicio') is-invalid @enderror" name="fecha_inicio"
                                                   value="{{$announcement->fecha_inicio}}" required autocomplete="name" autofocus>

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
                                            <input readonly id="fecha_fin" type="date"
                                                   class="form-control @error('fecha_fin') is-invalid @enderror" name="fecha_fin"
                                                   value="{{$announcement->fecha_fin}}" required autocomplete="name" autofocus>

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
                                                <option value="{{!@$announcement->descuento}}" {{!@$announcement?'selected':''}}> Selecciona un meses</option>
                                                @for ($i = 1; $i <= 12; $i++)
                                                    <option value="{{ $i }}" {{@$announcement->descuento===@$i?'selected':''}}> {{ $i }}
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
                                                <option value="{{!@$announcement->multa}}" {{!@$announcement?'selected':''}}> Selecciona un meses</option>
                                                @for ($i = 1; $i <= 12; $i++)
                                                    <option value="{{ $i }}" {{@$announcement->multa===@$i?'selected':''}}> {{ $i }}
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
                                            <input readonly id="monto_mes" type="number"
                                                   class="form-control @error('monto_mes') is-invalid @enderror" name="monto_mes"
                                                   value="{{$announcement->monto_mes}}" required autocomplete="name" autofocus>

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
                                            <input readonly id="monto_multa" type="number"
                                                   class="form-control @error('monto_multa') is-invalid @enderror" name="monto_multa"
                                                   value="{{$announcement->monto_multa}}" required autocomplete="name" autofocus>

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
                                            <input readonly id="monto_descuento" type="number"
                                                   class="form-control @error('monto_descuento') is-invalid @enderror" name="monto_descuento"
                                                   value="{{$announcement->monto_descuento}}" required autocomplete="name" autofocus>

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
                                            <input readonly id="monto_anual" type="number"
                                                   class="form-control @error('monto_anual') is-invalid @enderror" name="monto_anual"
                                                   value="{{$announcement->monto_anual}}" required autocomplete="name" autofocus>

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
                                            <input readonly id="cantidad_espacios" type="number"
                                                   class="form-control @error('cantidad_espacios') is-invalid @enderror" name="cantidad_espacios"
                                                   value="{{$announcement->cantidad_espacios}}" required autocomplete="name" autofocus>

                                            @error('cantidad_espacios')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="image" class="col-md-4 col-form-label">Foto</label>

                                        <div class="col-md-6">
                                            <img class="img-fluid" id="image"
                                                 src="{{ asset('storage/' . $announcement->image) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="row justify-content-center">
                                        <a href="{{asset('storage/'.@$announcement->file_announcement)}}" target="_blank"> Descargar Convocatoria</a>
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
@endsection
@section('scripts')
    <script>
        {{--const clients =  @json($clients);--}}
        function selectedAll(){
            $('input[type="checkbox"]').prop('checked', true);
        }
        function addDataChecks(name='selected_checks'){
            let checked = []
            $("input[name='users[]']:checked").each(function ()
            {
                checked.push(parseInt($(this).val()));
            });
            // const clients_selected = clients.filter(item=>checked.includes(item.id))
            /*const email_clients = clients_selected.map(
                item=> item.email?`<p class="text-start mb-0"> ${item.email}</p>`:''
            )*/
            $('#'+name).val(checked.join(','));
            // $('#body-chat').html(email_clients.join(''));
        }
    </script>
@endsection
