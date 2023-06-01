@extends('layouts.admin')

@section('content-admin')
    <div class="row">
        <div class="col-1 d-flex flex-column align-items-center justify-content-center">
            <a class="btn btn-primary bg-blue-dark" href="{{url('/reports')}}">
                Atras
            </a>
        </div>
        <div class="col-10">
            <form class="row my-3" action="{{route('hours_vehicle.store')}}" method="POST">
                @csrf
                    <div class="col-5 mb-3">
                        <label for="date_initial" class="col-6 col-form-label">fecha inicial</label>
                        <div class="col-6">
                            <input id="date_initial" type="date"
                                   class="form-control @error('hora_entrada') is-invalid @enderror" name="hora_entrada"
                                   value="" required autocomplete="name" autofocus>
                            @error('date_initial')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                       </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-5 mb-3">
                        <label for="date_fin" class="col-6 col-form-label">fecha final</label>

                        <div class="col-6">
                            <input id="date_fin" type="date"
                                   class="form-control @error('date_fin') is-invalid @enderror" name="date_fin"
                                   value="" required autocomplete="name" autofocus>

                            @error('date_fin')
                            <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                   </span>
                            @enderror
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
            <a href="{{route('horario.create')}}" class="btn btn-primary bg-blue-dark"> PDF</a>
        </div>
    </div>
    <table class="table table-striped table-blue-light">
        <thead>
        <tr>
            <th scope="col">fecha emision</th>
            <th scope="col">fecha fin emision</th>
            <th scope="col">Descuento</th>
            <th scope="col">Multa</th>
            <th scope="col">Monto mensual </th>
            <th scope="col">Monto anual</th>
            <th scope="col">Cantidad Esp</th>
            <th scope="col">Cantidad Esp</th>
            <th scope="col">Imagen</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th scope="col">fecha emision</th>
                <th scope="col">fecha fin emision</th>
                <th scope="col">Descuento</th>
                <th scope="col">Multa</th>
                <th scope="col">Monto mensual </th>
                <th scope="col">Monto anual</th>
                <th scope="col">Cantidad Esp</th>
                <th scope="col">Cantidad Esp</th>
                <th scope="col">Imagen</th>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
