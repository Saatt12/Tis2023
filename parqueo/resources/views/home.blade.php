@extends('layouts.admin')

@section('content-admin')
        <div ></div>
        <table class="table table-striped table-blue-light">
            <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">CI</th>
                <th scope="col">Email</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                  <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->ci}}</td>
                    <td>{{$user->email}}</td>
                      <td>
                          <a type="button" class="text-decoration-none me-3" href="{{ route('users.show', ['id' => $user->id]) }}">
                              Editar
                          </a>
                          <a type="button" class="text-decoration-none text-red-cherry" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                              Eliminar
                          </a>

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
                                              <form action="/users/{{ $user->id }}" method="POST" class="mt-3">
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

    </div>
@endsection
