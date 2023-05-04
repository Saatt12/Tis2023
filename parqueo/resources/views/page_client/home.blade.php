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
                            <a href="" class="btn btn-danger bg-red-cherry me-3" data-bs-toggle="modal"
                               data-bs-target="#payment_mode_">Pagar</a>
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
{{--                REGISTER VEHICLE                   --}}
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
{{--                REGISTER PAYMENT MODALS                 --}}
            <!-- Modal -->
                <div class="modal fade" id="payment_mode_" data-bs-backdrop="static" data-bs-keyboard="false"
                     tabindex="-1" aria-labelledby="payment_mode_Label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-red-cherry text-pink-light justify-content-center">
                                <h1 class="modal-title fs-5 text-center" id="payment_mode_Label"> Agregar Pago
                                </h1>
                            </div>
                            <div class="modal-body">
                                <div class="text-center">
                                    <form id="payment-form" method="POST" action="{{ route('payment.store') }}">
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="type" class="col-md-4 col-form-label">Modalidad de Pago</label>
                                            <div class="col-md-6">
                                                <select id="type" class="form-control"
                                                        onchange="selectedMethodPay(event)"
                                                        name="type" required autofocus>
                                                    <option value="" selected> Selecciona una Modalidad</option>
                                                    <option value="qr"> Qr</option>
                                                    <option value="manual"> Manual</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div id="content-form-data-pay" class="dis-none">
                                            <div id="content-qr" class="dis-none">
                                                <div class="row mb-3 justify-content-center">
                                                    <div class="col-5">
                                                        <div id="qrcode"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="number"
                                                       class="col-md-4 col-form-label">N.</label>

                                                <div class="col-md-6">
                                                    <input id="number" type="number"
                                                           class="form-control" name="number"
                                                           value="" required autocomplete="number">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="plan" class="col-md-4 col-form-label">Plan de pago</label>
                                                <div class="col-md-6">
                                                    <select id="plan" class="form-control"
                                                            name="plan" required
                                                    onchange="selectedPlan(event)"
                                                    >
                                                        <option value="" selected> Selecciona un plan</option>
                                                        <option value="anual"> Anual</option>
                                                        <option value="mensual"> Mensual</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="amount"
                                                       class="col-md-4 col-form-label">Monto</label>

                                                <div class="col-md-6">
                                                    <input id="amount" type="number"
                                                           class="form-control" name="amount"
                                                           value="" required>
                                                </div>
                                            </div>
                                            <div id="content-input-month" class="dis-none">
                                                <div class="row mb-3 ">
                                                    <label for="count" class="col-md-4 col-form-label">Meses</label>
                                                    <div class="col-md-6">
                                                        <select id="count" class="form-control"
                                                                name="count" required autofocus>
                                                            <option value="" selected> Selecciona un meses</option>
                                                            @for($i = 1; $i <= 12; $i++)
                                                            <option value="{{$i}}"> {{$i}} {{$i==1?'mes':'meses'}} </option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="user"
                                                       class="col-md-4 col-form-label">Nombre</label>

                                                <div class="col-md-6">
                                                    <input id="user" type="text"
                                                           class="form-control" readonly
                                                           value="{{auth()->user()->name}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                                <div class="col-4">
                                                    <button type="button" class="btn btn-secondary bg-blue-dark"
                                                            data-bs-dismiss="modal">Cancelar</button>
                                                </div>
                                                <div class="col-4">
                                                    <button type="submit" class="btn btn-secondary bg-blue-dark">Aceptar</button>
                                                </div>
                                            </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="success_payment_modal_" data-bs-backdrop="static" data-bs-keyboard="false"
                     tabindex="-1" aria-labelledby="success_payment_modal_Label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            {{--<div class="modal-header bg-red-cherry text-pink-light justify-content-center">
                                <h1 class="modal-title fs-5 text-center" id="success_payment_modal_Label"> Agregar Pago
                                </h1>
                            </div>--}}
                            <div class="modal-body">
                                <div class="row justify-content-center">
                                    <div class="col-8">
                                        <center>
                                    <img  src="{{asset('images/success_pay.jpg')}}" class="img-fluid" alt="">
                                        </center>
                                    </div>
                                </div>
                                <p class="text-center">Se realizo el pago con exito</p>
                                <div class="row justify-content-center">
                                    <div class="col-2">
                                        <button type="button" class="btn btn-secondary bg-blue-dark"
                                                data-bs-dismiss="modal">Aceptar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        new QRCode(document.getElementById("qrcode"), {
            text:"http://jindo.dev.naver.com/collie",
            width:150,
            height:150
        });
        function selectedMethodPay(e){
            const selected = e.target.value
            if(selected){
              $('#content-form-data-pay').show()
              if(selected === 'qr'){
                  $('#content-qr').show()
              }else {
                  $('#content-qr').hide()
              }
            }else {
                $('#content-form-data-pay').hide()
            }


        }
        function selectedPlan(e){
            const selected = e.target.value
            if(selected === 'mensual'){
                $('#content-input-month').show()
            }else {
                $('#content-input-month').hide()
            }
        }
        $("#payment-form").validate({
            rules: {
                type: "required",
            },
            messages: {
                type: "campo modalidad de pago es requerido",
            },
            submitHandler: function(form) {
                let token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'POST',
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    success: function(response) {
                        $('#payment_mode_').modal('hide')
                        $('#success_payment_modal_').modal('show')
                    },
                    error: function(xhr, status, error) {
                        // handle form submission error
                    }
                });
            }
        });
    </script>
@endsection
