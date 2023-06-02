@extends('layouts.admin')

@section('content-admin')
    <div class="row">
        <div class="col-1 d-flex flex-column align-items-center justify-content-center">
            <a class="btn btn-primary bg-blue-dark" href="{{url('/reports')}}">
                Atras
            </a>
        </div>
        <div class="col-10">
            <form class="row my-3" action="{{route('search_report_payments')}}" method="POST">
                @csrf
                <div class="col-5">
                    <div class="row mb-3">
                        <label for="date_initial" class="col-6 col-form-label">fecha inicial de registro</label>
                        <div class="col-6">
                            <input id="date_initial" type="date"
                                   class="form-control @error('date_initial') is-invalid @enderror" name="date_initial"
                                   value="{{$date_initial}}" autocomplete="name" autofocus>
                            @error('date_initial')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                       </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="date_fin" class="col-6 col-form-label">fecha final de registro</label>

                        <div class="col-6">
                            <input id="date_fin" type="date"
                                   class="form-control @error('date_fin') is-invalid @enderror" name="date_fin"
                                   value="{{$date_fin}}" autocomplete="name" autofocus>

                            @error('date_fin')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-4 d-flex flex-column align-items-center justify-content-center">
                    <div class="row">
                        <div class="col-3 d-flex flex-column align-items-center justify-content-center">
                            <label for="name" class="">Usuario</label>
                        </div>
                        <div class="col-9">
                            <input id="name" type="text"
                                   class="form-control @error('name') is-invalid @enderror" name="name"
                                   value="{{$name}}" autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                       </span>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="col-1 d-flex flex-column align-items-center justify-content-center">
                    <div class="">
                        <button type="submit" class="btn btn-primary bg-blue-dark">
                            Buscar
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-1 d-flex flex-column align-items-center justify-content-center">
            <form method="POST" action="{{ route('export_report_payments') }}" target="_blank">
                @csrf
                <input id="date_initial" type="hidden" value="{{$date_initial}}" name="date_initial">
                <input id="date_initial" type="hidden" value="{{$date_fin}}" name="date_fin">
                <input id="date_initial" type="hidden" value="{{$name}}" name="name">
                <button type="submit" class="btn btn-primary bg-blue-dark"> PDF</button>
            </form>
        </div>
    </div>
    <table class="table table-striped table-blue-light">
        <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Estado</th>
            <th scope="col">Detalle de pago</th>
        </tr>
        </thead>
        <tbody>
        @foreach($payments as $payment)
            <tr>
                <td>{{@$payment['user']->name}}</td>
                <td>{{@$payment['status']?$payment['status']:'Pagado'}}</td>
                <td>
                    <a onclick="selectedPayToShow({{ $payment->id }})"
                       class="btn btn-secondary bg-blue-dark" data-bs-toggle="modal"
                       data-bs-target="#payment_{{ $payment->id }}"> Ver </a>
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
                </div>
            </x-slot>
        </x-generic-modal>
    @endforeach
@endsection
