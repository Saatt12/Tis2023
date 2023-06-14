@extends('layouts.admin')

@section('content-admin')
    <div class="container">
        <div class="row justify-content-center pt-5">
            <div class="col-md-8 col-lg-7">
                <div class="bg-red-cherry pt-3 pb-3 text-center fw-bolder text-white mb-2">Formulario de Registro</div>
                <div class="card">
                    <div class="card-body">
                        <form class="ps-3" method="POST" action="{{ route('role.store') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="nom_role" class="col-md-4 col-form-label">Nombre</label>

                                <div class="col-md-6">
                                    <input id="nom_role" type="text"
                                           class="form-control @error('nom_role') is-invalid @enderror" name="nom_role"
                                           value="" required autocomplete="nom_role" autofocus>

                                    @error('nom_role')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
