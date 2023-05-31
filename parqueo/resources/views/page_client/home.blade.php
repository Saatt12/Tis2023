@extends('layouts.client')

@section('content-admin')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="w-100 px-3">
        <div class="row">
            <div class="col-3 pt-3">
                @if(@$announcement && @$announcement->image)
                    <img class="img-fluid" src="{{asset('storage/'.$announcement->image)}}" alt="">
                @else
                    <img class="img-fluid" src="{{ asset('images/advertising.png') }}" alt="">
                @endif
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
                            <a href="" class="btn btn-danger bg-red-cherry" data-bs-toggle="modal"
                                data-bs-target="#modal-payment-list">Lista recibos</a>
                        </div>
                        <div class="d-flex justify-content-center mb-4">
                            <a href="{{ url('client/vehicle') }}" class="btn btn-danger bg-red-cherry me-3">Registrar
                                vehiculo</a>
                            <a href="" class="btn btn-danger bg-red-cherry" data-bs-toggle="modal"
                                data-bs-target="#vehicle_registered_">Vehiculos registrados</a>
                        </div>
                        <div class="d-flex justify-content-center mb-4">
                            <a href="" class="btn btn-primary bg-blue-dark" data-bs-toggle="modal"
                                data-bs-target="#modal-request">Solicitud de parqueo</a>
                        </div>
                        <div class="d-flex justify-content-center mb-4">
                            <a href="{{ url('/client/claims') }}" class="btn btn-primary bg-blue-dark">
                                Reclamos
                                @if(@$news_messages && @$news_messages>0)
                                    <span class="badge badge-light bg-white text-black">{{$news_messages}}</span>
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row align-content-stretch">
                    @foreach ($parkings as $parking)
                        <div class="col-2">
                            @if($parking->status==='unavailable')
                                <p class="{{@$my_request && $my_request->parking_id ===$parking->id?'text-blue-dark':'text-red-cherry'}}">{{ $parking->name }}</p>
                            @else
                                <p>{{ $parking->name }}</p>
                            @endif
                        </div>
                    @endforeach
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

                {{--                PAYMENT MODALS                   --}}
                <x-list-payment name="modal-payment-list" title="lista de recibos">
                    <slot>
                        @foreach ($payments as $key => $payment)
                            <div class="col-7 pb-2">
                                {{ $payment->created_at }}
                            </div>
                            <div class="col-5 pb-2">
                                <a onclick="selectedPayToShow({{ $payment->id }})"
                                    class="btn btn-secondary bg-blue-dark" data-bs-toggle="modal"
                                    data-bs-target="#payment_{{ $payment->id }}"> Ver </a>
                            </div>
                        @endforeach
                    </slot>
                </x-list-payment>
                @foreach ($payments as $payment)
                    <x-generic-modal name="payment_{{ $payment->id }}" title="Pago">
                        <x-slot name="content" class="">
                            <div class="row mb-3">
                                <label for="type" class="col-md-4 col-form-label">Modalidad de Pago</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="type" disabled>
                                        <option value="" {{ !$payment->type ? 'selected' : '' }}> Selecciona una
                                            Modalidad</option>
                                        <option value="qr" {{ $payment->type == 'qr' ? 'selected' : '' }}> Qr</option>
                                        <option value="manual" {{ $payment->type == 'manual' ? 'selected' : '' }}> Manual
                                        </option>
                                    </select>
                                </div>
                            </div>
                            @if (@$payment->type === 'qr')
                                <div>
                                    <div class="row mb-3 justify-content-center">
                                        <div class="col-5">
                                            <div id="qrcode_show_{{ $payment->id }}" class="qrcode_show"></div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row mb-3">
                                <label for="number" class="col-md-4 col-form-label">Nro de recibo</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="number"
                                        value="{{ $payment->number }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="plan" class="col-md-4 col-form-label">Plan de pago</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="plan" disabled>
                                        <option value="" selected> Selecciona un plan</option>
                                        <option value="anual" {{ @$payment->plan === 'anual' ? 'selected' : '' }}> Anual
                                        </option>
                                        <option value="mensual" {{ @$payment->plan === 'mensual' ? 'selected' : '' }}> Mensual
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="amount" class="col-md-4 col-form-label">Monto</label>

                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="amount"
                                        value="{{ $payment->amount }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="amount" class="col-md-4 col-form-label">Documento Adjunto</label>

                                <div class="col-md-6">
                                    <a href="{{asset('storage/'.@$payment->comprobante)}}" target="_blank">{{@$payment->comprobante}}</a>
                                </div>
                            </div>
                            @if (@$payment->count)
                                <div class="row mb-3 ">
                                    <label for="count" class="col-md-4 col-form-label">Meses</label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="count" disabled>
                                            <option value="" selected> Selecciona un meses</option>
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}"
                                                    {{ @$payment->count === $i ? 'selected' : '' }}> {{ $i }}
                                                    {{ $i == 1 ? 'mes' : 'meses' }} </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            @endif
                            <div class="row mb-3">
                                <label for="user" class="col-md-4 col-form-label">Nombre</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" readonly disabled
                                        value="{{ auth()->user()->name }}">
                                </div>
                            </div>

                        </x-slot>
                        <x-slot name="buttons">
                            <div class="row justify-content-center">
                                <div class="col-4">
                                    <button type="button" class="btn btn-secondary bg-blue-dark"
                                        data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </x-slot>
                    </x-generic-modal>
                @endforeach
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
                                    <form id="payment-form" method="POST" action="{{ route('payment.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="type" class="col-md-4 col-form-label">Modalidad de
                                                Pago</label>
                                            <div class="col-md-6">
                                                <select id="type" class="form-control"
                                                    onchange="selectedMethodPay(event)" name="type" required autofocus>
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
                                                <label for="number" class="col-md-4 col-form-label">Nro de recibo</label>
                                                <div class="col-md-6">
                                                    <input id="number" type="number" class="form-control"
                                                        name="number" value="" required autocomplete="number">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="plan" class="col-md-4 col-form-label">Plan de pago</label>
                                                <div class="col-md-6">
                                                    <select id="plan" class="form-control" name="plan" required
                                                        onchange="selectedPlan(event)">
                                                        <option value="" selected> Selecciona un plan</option>
                                                        <option value="anual"> Anual</option>
                                                        <option value="mensual"> Mensual</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="amount" class="col-md-4 col-form-label">Monto</label>

                                                <div class="col-md-6">
                                                    <input id="amount" type="number" class="form-control"
                                                        name="amount" value="" required readonly>
                                                </div>
                                            </div>
                                            <div id="content-input-month" class="dis-none">
                                                <div class="row mb-3 ">
                                                    <label for="count" class="col-md-4 col-form-label">Meses</label>
                                                    <div class="col-md-6">
                                                        <select onchange="selectedMonth(event)" id="count" class="form-control" name="count"
                                                            required autofocus>
                                                            <option value="" selected> Selecciona un meses</option>
                                                            @for ($i = 1; $i <= 12; $i++)
                                                                <option value="{{ $i }}"> {{ $i }}
                                                                    {{ $i == 1 ? 'mes' : 'meses' }} </option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="user" class="col-md-4 col-form-label">Nombre</label>

                                                <div class="col-md-6">
                                                    <input id="user" type="text" class="form-control" readonly
                                                        value="{{ auth()->user()->name }}">
                                                </div>
                                            </div>
                                            <div class="row mb-3 content-qr">
                                                <label for="comprobante" class="col-md-4 col-form-label">Adjuntar Comprobante</label>

                                                <div class="col-md-6">
                                                    <input id="comprobante" accept="application/pdf,image/*" type="file" class="form-control" name="comprobante">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-4">
                                                <button type="button" class="btn btn-secondary bg-blue-dark"
                                                    data-bs-dismiss="modal">Cancelar</button>
                                            </div>
                                            <div class="col-4">
                                                <button type="submit"
                                                    class="btn btn-secondary bg-blue-dark">Aceptar</button>
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
                            {{-- <div class="modal-header bg-red-cherry text-pink-light justify-content-center">
                                <h1 class="modal-title fs-5 text-center" id="success_payment_modal_Label"> Agregar Pago
                                </h1>
                            </div> --}}
                            <div class="modal-body">
                                <div class="row justify-content-center">
                                    <div class="col-8">
                                        <center>
                                            <img src="{{ asset('images/success_pay.jpg') }}" class="img-fluid"
                                                alt="">
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
                {{--                REQUEST MODALS                   --}}
                <x-generic-modal name="modal-request" title="Solicitud">
                    <x-slot name="content" class="">
                        <form action="{{ route('request_form.store') }}" method="POST">
                            @csrf
                            <p>
                                ¿Desea solicitar un parqueo ?
                            </p>
                            <div class="row justify-content-center">
                                <div class="col-4">
                                    <button type="button" class="btn btn-secondary bg-blue-dark"
                                        data-bs-dismiss="modal">Cerrar</button>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-secondary bg-blue-dark"
                                        data-bs-dismiss="modal">Aceptar</button>
                                </div>
                            </div>
                        </form>
                    </x-slot>
                    <x-slot name="buttons" class=""></x-slot>
                </x-generic-modal>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        const announcement =  {!! json_encode(@$announcement) !!}
       {{-- const multa =  {!! json_encode($announcement->multa) !!}
        const monto_mes =  {!! json_encode($announcement->monto_mes) !!}
        const monto_multa =  {!! json_encode($announcement->monto_multa) !!}
        const monto_descuento =  {!! json_encode($announcement->monto_descuento) !!}
        const monto_anual =  {!! json_encode($announcement->monto_anual) !!}
        const cantidad_espacios =  {!! json_encode($announcement->cantidad_espacios) !!}--}}
        new QRCode(document.getElementById("qrcode"), {
            text: "http://jindo.dev.naver.com/collie",
            width: 150,
            height: 150
        });

        function selectedMethodPay(e) {
            const selected = e.target.value
            if (selected) {
                $('#content-form-data-pay').show()
                if (selected === 'qr') {
                    $('#content-qr').show()
                    $('.content-qr').show()
                } else {
                    $('#content-qr').hide()
                    $('.content-qr').hide()
                }
            } else {
                $('#content-form-data-pay').hide()
            }


        }
        function selectedMonth(e){
            const selected = e.target.value
            if(announcement){
                $('#amount').val(announcement.monto_mes*selected)
            }

        }
        function selectedPlan(e) {
            const selected = e.target.value
            if (selected === 'mensual') {
                $('#amount').val('')
                $('#content-input-month').show()
            } else {
                $('#amount').val('')
                $('#content-input-month').hide()
            }
            if (selected === 'anual'){
                $('#amount').val(announcement.monto_anual)
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
                //console.log("-> $(form).serialize()", $(form).serialize());
                let formData = new FormData(form);
                // console.log("-> formData", formData);
                let token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'POST',
                    url: $(form).attr('action'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    enctype: 'multipart/form-data',
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    success: function(response) {
                        console.log("-> response", response);
                        $('#payment_mode_').modal('hide')
                        $('#success_payment_modal_').modal('show')
                        location.reload()
                    },
                    error: function(xhr, status, error) {
                        console.log("-> error", error);
                    }
                });
            }
        });

        function selectedPayToShow(id) {
            const element = document.getElementById("qrcode_show_" + id);
            if (element) {
                new QRCode(document.getElementById("qrcode_show_" + id), {
                    text: "http://jindo.dev.naver.com/collie",
                    width: 150,
                    height: 150
                });
            }
        }
    </script>
@endsection
