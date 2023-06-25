@extends('layouts.admin')

@section('content-admin')
    <div class="row">
        <div class="col-1 d-flex flex-column align-items-center justify-content-center">
            <a class="btn btn-primary bg-blue-dark" href="{{url('/reports')}}">
                Atras
            </a>
        </div>
        <div class="col-10">
            <form class="row my-3" action="{{route('search_report_announcement')}}" method="POST">
                @csrf
                    <div class="col-5 mb-3">
                        <div class="row">
                        <label for="date_initial" class="col-6 col-form-label">fecha inicial</label>
                        <div class="col-6">
                            <input id="date_initial" type="date"
                                   class="form-control @error('date_initial') is-invalid @enderror" name="date_initial"
                                   value="{{$date_initial}}" >
                            @error('date_initial')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                       </span>
                            @enderror
                        </div>
                        </div>
                    </div>
                    <div class="col-5 mb-3">
                        <div class="row">
                        <label for="date_fin" class="col-6 col-form-label">fecha final</label>

                        <div class="col-6">
                            <input id="date_fin" type="date"
                                   class="form-control @error('date_fin') is-invalid @enderror" name="date_fin"
                                   value="{{$date_fin}}">
                            @error('date_fin')
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
            <form method="POST" action="{{ route('export_report_announcement') }}" target="_blank">
                @csrf
                <input id="date_initial" type="hidden" value="{{$date_initial}}" name="date_initial">
                <input id="date_initial" type="hidden" value="{{$date_fin}}" name="date_fin">
                <button type="submit" class="btn btn-primary bg-blue-dark"> PDF</button>
            </form>
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
            <th scope="col">Imagen</th>
        </tr>
        </thead>
        <tbody>
        @foreach($announcements as $announcement)
            <tr>
                <th scope="col">{{$announcement->fecha_inicio }}</th>
                <th scope="col">{{$announcement->fecha_fin }}</th>
                <th scope="col">{{$announcement->descuento }}</th>
                <th scope="col">{{$announcement->multa }}</th>
                <th scope="col">{{$announcement->monto_mes }} </th>
                <th scope="col">{{$announcement->monto_anual }}</th>
                <th scope="col">{{$announcement->cantidad_espacios }}</th>
                <th scope="col">
                    <img src="{{asset('storage/'.$announcement->image)}}" alt=""  style="max-width: 100px">
                   </th>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
