@extends('layouts.admin')

@section('content-admin')
    @if(@$user_permission->contains('crear_cargo'))
    <div >
        <a href="{{route('cargo.create')}}" class="btn btn-primary m-2"> Añadir Cargo</a>
    </div>
    @endif
    <table class="table table-striped table-blue-light">
        <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($cargos as $cargo)
            <tr>
                <td>{{$cargo->nom_cargo}}</td>
                <td>
                    @if(@$user_permission->contains('editar_cargo'))
                    <a type="button" class="text-decoration-none me-3" href="{{ route('cargo.show', ['id' => $cargo->id]) }}">
                        Editar
                    </a>
                    @endif
                    @if(@$user_permission->contains('eliminar_cargo'))
                    <a type="button" class="text-decoration-none text-red-cherry" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$cargo->id}}">
                        Eliminar
                    </a>
                    @endif

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop{{$cargo->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-red-cherry text-pink-light justify-content-center">
                                    <h1 class="modal-title fs-5 text-center" id="staticBackdropLabel">Confirmar </h1>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center">
                                        ¿Deseas eliminar  este cargo?
                                        <form action="/cargos/{{ $cargo->id }}" method="POST" class="mt-3">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-secondary bg-blue-dark" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary bg-blue-dark">Aceptar</button>

                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
