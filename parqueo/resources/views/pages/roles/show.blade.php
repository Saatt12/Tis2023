@extends('layouts.admin')

@section('content-admin')
    <div class="container">
        <div class="row justify-content-center pt-5">
            <div class="col-md-8 col-lg-7">
                <div class="bg-red-cherry pt-3 pb-3 text-center fw-bolder text-white mb-2">Editar Horario</div>
                <div class="card">
                    <div class="card-body">
                        <form class="ps-3" method="POST" action="{{ route('role.update', $role->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label">Nombre Horario</label>

                                <div class="col-md-6">
                                    <input id="nom_role" type="text"
                                           class="form-control @error('nom_role') is-invalid @enderror" name="nom_role"
                                           value="{{@$role->nom_role}}" required autocomplete="nom_role" autofocus>

                                    @error('nom_role')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nom_role" class="col-md-4 col-form-label">Permisos</label>
                                <div class="col-md-6">
                                    <div class="row">
                                        @foreach($permissions as $key=>$permission)
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input {{$permission->type!==@$permissions[$key-1]->type?'parent-checkbox':$permission->type}}"
                                                           name="permissions[]"
                                                           data-target=".{{$permission->type}}"
                                                           {{$permission->type===@$permissions[$key-1]->type?'disabled':''}}
                                                           {{$role_permissions->contains($permission->id)?'checked':''}}
                                                           type="checkbox" value="{{$permission->id}}"
                                                           id="flexCheckDefault">
                                                    <label class="form-check-label " for="flexCheckDefault">
                                                        @if($permission->type!==@$permissions[$key-1]->type)
                                                            <strong>{{$permission->name}} </strong>
                                                        @else
                                                            {{$permission->name}}
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5 justify-content-center">
                                <div class="col-md-3"></div>

                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary bg-blue-dark">
                                        Aceptar
                                    </button>
                                </div>
                                <div class="col-md-4 ">
                                    <a class="btn btn-primary bg-blue-dark" href="{{ url('/roles') }}">
                                        Cancelar
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.parent-checkbox').on('change', function() {
                let target = $(this).data('target');
                let isChecked = $(this).prop('checked');
                $(target).prop('checked', isChecked).prop('disabled', !isChecked);
            });
            $('.parent-checkbox').trigger('change');
        });
    </script>
@endsection
