@extends('layouts.admin')

@section('content-admin')
    <div >
        <a href="{{route('unidad.create')}}" class="btn btn-primary m-2"> Añadir Cargo</a>
    </div>
    <table class="table table-striped table-blue-light">
        <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($unidades as $unidad)
            <tr>
                <td>{{$unidad->nom_unidad}}</td>
                <td>
                    <a type="button" class="text-decoration-none me-3" href="{{ route('unidad.show', ['id' => $unidad->id]) }}">
                        Editar
                    </a>
                    <a type="button" class="text-decoration-none text-red-cherry" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$unidad->id}}">
                        Eliminar
                    </a>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop{{$unidad->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-red-cherry text-pink-light justify-content-center">
                                    <h1 class="modal-title fs-5 text-center" id="staticBackdropLabel">Confirmar </h1>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center">
                                        ¿Deseas eliminar  este unidad?
                                        <form action="/unidades/{{ $unidad->id }}" method="POST" class="mt-3">
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
