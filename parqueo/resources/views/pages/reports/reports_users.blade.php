@extends('layouts.admin')

@section('content-admin')
    <div class="row">
        <div class="col-1 d-flex flex-column align-items-center justify-content-center">
            <a class="btn btn-primary bg-blue-dark" href="{{url('/reports')}}">
                Atras
            </a>
        </div>
        <div class="col-10">
        <form class="row my-3" action="{{route('search_report_users')}}" method="POST">
            @csrf
               <div class="col-2 d-flex flex-column align-items-center justify-content-center">
                   <select id="announcement" class="form-control @error('announcement_id') is-invalid @enderror"
                           name="announcement_id" autofocus>
                       <option value="" {{ !@$announcement_id ? 'selected' : '' }}> Convocatoria</option>
                       @foreach ($announcements as $announcement)
                           <option value="{{$announcement->id}}" {{$announcement->id === @$announcement_id ? 'selected' : '' }}>{{ $announcement->fecha_inicio }} - {{ $announcement->fecha_fin }}</option>
                       @endforeach
                   </select>
                   @error('announcement_id')
                   <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                       </span>
                   @enderror
               </div>
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
            <form method="POST" action="{{ route('export_report_users') }}" target="_blank">
                @csrf
                <input id="date_initial" type="hidden" value="{{$announcement_id}}" name="announcement_id">
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
            <th scope="col">CI</th>
            <th scope="col">Email</th>
            <th scope="col">Rol</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user['name']}}</td>
                <td>{{$user['ci']}}</td>
                <td>{{$user['email']}}</td>
                <td>{{$user->rol->nom_role}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
