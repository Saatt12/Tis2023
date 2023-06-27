@extends('layouts.admin')

@section('content-admin')
    <div >
        @if(@$user_permission->contains('crear_rol'))
        <a href="{{route('role.create')}}" class="btn btn-primary m-2"> Añadir Rol</a>
        @endif
    </div>
    <table class="table table-striped table-blue-light">
        <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($roles as $role)
            <tr>
                <td>{{$role->nom_role}}</td>
                <td>
                    @if(@$user_permission->contains('editar_rol'))
                    <a type="button" class="text-decoration-none me-3" href="{{ route('role.show', ['id' => $role->id]) }}">
                        Editar
                    </a>
                    @endif
                    @if(!($role->id>=1 && $role->id<=4))
                    @if(@$user_permission->contains('eliminar_rol'))
                        <a type="button" class="text-decoration-none text-red-cherry" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$role->id}}">
                        Eliminar
                    </a>
                            @endif

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop{{$role->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-red-cherry text-pink-light justify-content-center">
                                    <h1 class="modal-title fs-5 text-center" id="staticBackdropLabel">Confirmar </h1>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center">
                                        ¿Deseas eliminar  este rol?
                                        <form action="/roles/{{ $role->id }}" method="POST" class="mt-3">
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
                    @endif

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
