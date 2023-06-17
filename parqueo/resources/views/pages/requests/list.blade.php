@extends('layouts.admin')
@section('subhead-custom')
<div class="d-flex">
    <form action="{{route('search_request')}}" method="POST">
        @csrf
        <input type="search" name="keyword" value="{{@$keyword}}">
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>
</div>
@endsection

@section('content-admin')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-striped table-blue-light">
        <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">CI</th>
            <th scope="col">Email</th>
            <th scope="col">Asignado</th>
            <th scope="col">
                @if(@$user_permission->contains('asignar_parqueo') || @$user_permission->contains('rechazar_parqueo'))
                <button onclick="selectedAll()" type="button" class="btn btn-primary bg-blue-dark">
                    Seleccionar Todo
                </button>
                @endif
                @if(@$user_permission->contains('asignar_parqueo'))
                <button
                    type="button"
                    onclick="addDataChecks()"
                    class="btn btn-primary bg-blue-dark"
                    data-bs-toggle="modal"
                    data-bs-target="#assign-modal"
                >
                    Asignar Parqueo
                </button>
                    @endif
                @if(@$user_permission->contains('rechazar_parqueo'))
                <button
                    type="button"
                    class="btn btn-primary bg-blue-dark"
                    data-bs-toggle="modal"
                    data-bs-target="#reject-modal"
                    onclick="addDataChecks('selected_checks_reject')"
                >
                    Rechazar
                </button>
                    @endif
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($requests as $request)
            <tr>
                <td>{{$request->user->name}}</td>
                <td>{{$request->user->ci}}</td>
                <td>{{$request->user->email}}</td>
                <td>{{@$request->parking_id?'SI':'NO'}}</td>
                <td>
                    <div class="row justify-content-center">
                        <div class="col-3">
                            <a
                                href=""
                                class="text-blue-dark text-decoration-none"
                                data-bs-toggle="modal"
                                data-bs-target="#manual_assign_{{$request->id}}"
                            > ASIGNAR </a>
                        </div>
                        <div class="col-1">
                    <input type="checkbox" name="items[]" value="{{$request->id}}" class="form-check-input">

                        </div></div>
                    <x-generic-modal name="manual_assign_{{$request->id}}" title="Asignar">
                        <x-slot name="content" class="">
                            <form action="{{ route('request.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row py-3">
                                <label for="requests_list" class="col-md-4 col-form-label text-black">Manual</label>
                                    <div class="col-md-6">

                                <select id="requests_list" class="form-control " name="parking_id" required autofocus>
                                    <option value="" > Selecciona Parking Manual</option>
                                    @foreach($parkings as $parking)
                                        @if(@$request->parking_id && @$request->parking_id === $parking->id)
                                            <option
                                                value="{{$parking->id}}"
                                                selected
                                            >
                                                {{$parking->name}}
                                            </option>
                                        @endif
                                        @if($parking->status==='available')
                                          <option
                                              value="{{$parking->id}}"
                                          >
                                              {{$parking->name}}
                                          </option>
                                        @endif
                                    @endforeach

                                </select>
                                        <input type="hidden" value="{{@$request->id}}" name="request_id">
                                    </div>
                                </div>
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
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
        <x-generic-modal name="assign-modal" title="Confirmar">
            <x-slot name="content" class="">
                <form action="{{ route('request.store') }}" method="POST">
                    @csrf
                    <p>
                        ¿Desea aceptar esta cuenta?
                    </p>
                    <input type="hidden" id="selected_checks" name="request_ids">
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
    <x-generic-modal name="reject-modal" title="Confirmar">
        <x-slot name="content" class="">
            <form action="{{ route('request.delete') }}" method="POST">
                @csrf
                @method('DELETE')
                <p>
                    ¿Deseas rechazar la(s) solicitud(es)?
                </p>
                <input type="hidden" id="selected_checks_reject" name="request_ids">
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
@endsection
@section('scripts')
    <script>
        function selectedAll(){
            $('input[type="checkbox"]').prop('checked', true);
        }
        function addDataChecks(name='selected_checks'){
            let checked = []
            $("input[name='items[]']:checked").each(function ()
            {
                checked.push(parseInt($(this).val()));
            });
            $('#'+name).val(checked.join(','));
        }
    </script>
@endsection
