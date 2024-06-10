@extends('auth.layouts.app')

@section('title', 'Login')

@section('content')
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent p-4 text-center">
                        <div class="text-center text-muted">
                            <small>Ingresa con tus credenciales</small>
                        </div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">

                        {{-- * Start form login --}}

                        <form id="loginUserForm" role="form" method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="email">Correo *</label>
                                <div class="input-group input-group-alternative">
                                    <input id="email" type="email"
                                        class="form-control input-form-class @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                        placeholder="Ingrese su correo">
                                </div>
                                @error('email')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <span class="alert-text"> Las credenciales ingresadas no son válidas. </span>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña *</label>
                                <div class="input-group input-group-alternative">
                                    <input id="password" type="password"
                                        class="form-control input-form-class @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="current-password" placeholder="Contraseña">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="custom-control custom-control-alternative custom-checkbox">

                                <input class="custom-control-input" type="checkbox" name="remember"
                                    id="remember customCheckLogin" {{ old('remember') ? 'checked' : '' }}>

                                <label class="custom-control-label" for="remember customCheckLogin">
                                    <span class="text-muted">Recuerdamelo</span>
                                </label>

                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">Ingresar</button>
                            </div>

                        </form>

                        {{-- * End form login --}}

                        <div class="row mt-3">
                            {{-- <div class="col-6">

                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-muted"><small>Olvidaste tu
                                            contraseña?</small></a>
                                @endif

                            </div> --}}
                            <div class="col-12 text-right">
                                <a href="{{ route('register') }}" class="text-muted"><small>Regístrate!</small></a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('optional_scripts')
    <script src="{{ asset('assets/js/plugins/jquery-validator/jQueryValidator.min.js') }}"></script>
    <script src="{{ asset('assets/js/auth/login.js') }}"></script>
@endsection
