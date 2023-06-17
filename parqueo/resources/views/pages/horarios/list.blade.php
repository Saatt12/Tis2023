@extends('layouts.admin')

@section('content-admin')
    <div >
        @if(@$user_permission->contains('crear_horario'))
        <a href="{{route('horario.create')}}" class="btn btn-primary m-2"> Añadir Horario</a>
        @endif
    </div>
    <table class="table table-striped table-blue-light">
        <thead>
        {{--<tr>
            <th scope="col">Nombre</th>
            <th scope="col">CI</th>
            <th scope="col">Email</th>
            <th></th>
        </tr>--}}
        </thead>
        <tbody>
        @foreach($horarios as $horario)
            <tr>
                <td>{{$horario->nom_turno}}</td>
                <td>{{$horario->hora_entrada}} - {{$horario->hora_salida}}</td>
                <td>
                    @if(@$user_permission->contains('editar_horario'))
                    <a type="button" class="text-decoration-none me-3" href="{{ route('horario.show', ['id' => $horario->id]) }}">
                        Editar
                    </a>
                    @endif
                    @if(@$user_permission->contains('eliminar_horario'))
                    <a type="button" class="text-decoration-none text-red-cherry" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Eliminar
                    </a>
                    @endif

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-red-cherry text-pink-light justify-content-center">
                                    <h1 class="modal-title fs-5 text-center" id="staticBackdropLabel">Confirmar </h1>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center">
                                        ¿Deseas eliminar  esta cuenta?
                                        <form action="/horarios/{{ $horario->id }}" method="POST" class="mt-3">
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
