@extends('layouts.app')

@section('content')
    <div class="separation-content-login"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <img class="image-park mt-2" src="{{ asset('images/background_parqueo.png') }}" alt="">
            </div>
            <div class="col-6">
                <div class="pt-5">
                    {{-- <div class="card-header">{{ __('Login') }}</div> --}}

                    <div class="">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-7">
                                    <div class="py-3">
                                        <div class="form-floating">

                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus
                                                placeholder="Usuario">
                                            <label for="email" class="">Usuario</label>
                                        </div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>

                                    <div class="py-3">
                                        <div class="form-floating">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="current-password"
                                                placeholder="Password">
                                            <label for="password" for="password">Contraseña</label>
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>

                                    {{-- <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div> --}}

                                    <div class="row py-3 justify-content-center">
                                        <div class="col-8">
                                            {{-- <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button> --}}
                                            <button type="submit" class="btn btn-primary w-100 bg-blue-dark">
                                                Ingresar
                                            </button>
                                            {{-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif --}}
                                            <div class="text-center mt-3">
                                                <a class="text-blue-dark text-decoration-none "
                                                    href="{{ route('register') }}">Registrarse</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
