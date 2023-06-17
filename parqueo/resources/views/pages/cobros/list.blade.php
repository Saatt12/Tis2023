@extends('layouts.admin')

@section('content-admin')
    <div class="row w-100">
        <div class="col-10">
            <form class="row my-3" action="{{route('cobro.search')}}" method="POST">
                @csrf
                <div class="col-12">
                    <div class="row">
                        <div class="col-3 d-flex flex-column align-items-center justify-content-center">
                            <label for="name" class="">Usuario</label>
                        </div>
                        <div class="col-5">
                            <input id="name" type="text"
                                   class="form-control @error('name') is-invalid @enderror" name="name"
                                   value="{{$name}}" autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                       </span>
                            @enderror
                        </div>
                        <div class="col-1 d-flex flex-column align-items-center justify-content-center">
                            <div class="">
                                <button type="submit" class="btn btn-primary bg-blue-dark">
                                    Buscar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div>
        <a href=""
          class="btn btn btn-primary me-3 my-2"
          data-bs-toggle="modal"
          data-bs-target="#payment_mode_">Realizar Cobro Manual</a>

    </div>
    <table class="table table-striped table-blue-light">
        <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">tipo</th>
            <th scope="col">Estado</th>
            <th scope="col">Detalle de pago</th>
        </tr>
        </thead>
        <tbody>
        @foreach($payments as $payment)
            <tr>
                <td>{{@$payment['user']->name}}</td>
                <td>{{strtoupper(@$payment->type?@$payment->type:'')}}</td>
                <td>{{@$payment['status']?$payment['status']:'Pendiente'}}</td>
                <td>
                    <div class="d-flex flex-wrap">

                    <a onclick="selectedPayToShow({{ $payment->id }})"
                       class="btn btn-secondary bg-blue-dark" data-bs-toggle="modal"
                       data-bs-target="#payment_{{ $payment->id }}"> Detalle </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
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
                               value="{{ $payment->id }}" disabled>
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
                @if(@$payment->type==='qr')
                <div class="row mb-3">
                    <label for="amount" class="col-md-4 col-form-label">Documento Adjunto</label>

                    <div class="col-md-6">
                        <a href="{{asset('storage/'.@$payment->comprobante)}}" target="_blank">{{@$payment->comprobante}}</a>
                    </div>
                </div>
                @endif
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
                               value="{{ @$payment->user->name }}">
                    </div>
                </div>

            </x-slot>
            <x-slot name="buttons">
                <div class="row justify-content-center">
                    <div class="col-4">
                        <button type="button" class="btn btn-secondary bg-blue-dark"
                                data-bs-dismiss="modal">Cerrar</button>
                    </div>
                    @if(@$payment->type==='qr' && !@$payment->status)
                        <div class="col-4">
                            <form action="{{route('cobro.verified')}}" method="POST">
                                @csrf
                                <input type="hidden" name="payment_id" value="{{$payment->id}}">
                                <button class="btn btn-primary bg-blue-dark">
                                    Verificar Pago
                                </button>
                            </form>
                        </div>
                    @endif
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
                        <form id="payment-form" method="POST" action="{{ route('cobro.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="type" class="col-md-4 col-form-label">Modalidad de
                                    Pago</label>
                                <div class="col-md-6">
                                    <select id="type" class="form-control"
                                            onchange="selectedMethodPay(event)" name="type" required autofocus>
                                        <option value="" selected> Selecciona una Modalidad</option>
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
                                    <label for="user_id" class="col-md-4 col-form-label">Usuario</label>
                                    <div class="col-md-6">
                                        <select id="user_id" class="form-control" name="user_id"
                                                required autofocus>
                                            <option value="" selected> Selecciona cliente</option>
                                            @foreach($requests as $request)
                                                <option value="{{ $request->user->id }}">
                                                    {{$request->user->name}}</option>
                                            @endforeach
                                        </select>
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
@endsection
@section('scripts')
    <script>
        const announcement =  {!! json_encode(@$announcement) !!}
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
