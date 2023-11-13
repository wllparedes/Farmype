@extends('auth.layouts.app')

@section('title', 'Registrarse')

@section('optional_links')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/select2.min.css') }}">
@endsection

@section('content')
    <div class="container mt--8 pb-5">
        <!-- Table -->
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <div class="text-center text-muted">
                            <small>Registro de Usuario</small>
                        </div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">

                        {{-- * Start form register --}}

                        <form id="registerUserForm" role="form" method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group">
                                <label for="select-document-type">Tipo de documento *</label>
                                <div class="input-group input-group-alternative mb-3">
                                    <select id="select-document-type"
                                        class="form-control js-example-basic-single input-form-class" name="document_type">
                                        <option></option>
                                        @foreach ($documentTypes as $key => $type)
                                            <option value="{{ $key }}"> {{ $type }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="document_number">Número de documento *</label>
                                <div class="input-group input-group-alternative mb-3">
                                    <input id="document_number" type="text"
                                        class="form-control input-form-class @error('document_number') is-invalid @enderror"
                                        name="document_number" value="{{ old('document_number') }}" required
                                        autocomplete="document_number" autofocus
                                        placeholder="Ingresa el número de documento">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="names_surnames">Nombres y apellidos *</label>
                                <div class="input-group input-group-alternative mb-3">

                                    <input id="names_surnames" type="text"
                                        class="form-control input-form-class @error('names_surnames') is-invalid @enderror"
                                        name="names_surnames" value="{{ old('names_surnames') }}" required
                                        autocomplete="names_surnames" autofocus
                                        placeholder="Ingresa los nombres y apellidos">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="select-role">Tipo de usuario *</label>
                                <div class="input-group input-group-alternative mb-3">
                                    <select id="select-role" class="form-control input-form-class"
                                        name="role">
                                        <option></option>
                                        @foreach ($roles as $key => $role)
                                            <option value="{{ $key }}"> {{ $role }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="select-departament">Departamento *</label>
                                <div class="input-group input-group-alternative mb-3">
                                    <select id="select-departament" class="form-control input-form-class"
                                        name="departament">
                                        <option></option>
                                        @foreach ($departaments as $key => $departament)
                                            <option value="{{ $key }}"> {{ $departament }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="select-province">Provincia *</label>
                                <div class="input-group input-group-alternative mb-3">
                                    <select id="select-province"
                                        class="form-control js-example-basic-single input-form-class" name="province">
                                        <option></option>
                                        @foreach ($provinces as $key => $province)
                                            <option value="{{ $key }}"> {{ $province }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="select-district">Distrito *</label>
                                <div class="input-group input-group-alternative mb-3">

                                    <select id="select-district"
                                        class="form-control js-example-basic-single input-form-class" name="district">
                                        <option></option>
                                        @foreach ($districts as $key => $district)
                                            <option value="{{ $key }}"> {{ $district }} </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address">Dirección *</label>
                                <div class="input-group input-group-alternative mb-3">
                                    <input id="address" type="text"
                                        class="form-control input-form-class @error('address') is-invalid @enderror"
                                        name="address" value="{{ old('address') }}" required autocomplete="address"
                                        autofocus placeholder="Dirección">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phone">Telefono *</label>
                                <div class="input-group input-group-alternative mb-3">
                                    <input id="phone" type="text"
                                        class="form-control input-form-class @error('phone') is-invalid @enderror"
                                        name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus
                                        placeholder="Número de teléfono">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Correo *</label>
                                <div class="input-group input-group-alternative mb-3">
                                    <input id="email" type="email"
                                        class="form-control input-form-class @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email"
                                        placeholder="Correo del Usuario">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password">Contraseña *</label>
                                <div class="input-group input-group-alternative">
                                    <input id="password" type="password"
                                        class="form-control input-form-class @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="new-password" placeholder="Contraseña">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm">Repita su contraseña *</label>
                                <div class="input-group input-group-alternative">

                                    <input id="password-confirm" type="password" class="form-control input-form-class"
                                        name="password_confirmation" required autocomplete="new-password"
                                        placeholder="Confirme su contraseña">

                                </div>
                            </div>

                            <div class="text-muted font-italic password-strength" id="password-strength">
                                <small>
                                    fuerza de la contraseña:
                                    <span class="text-danger font-weight-700 span-password">débil</span>
                                </small>
                                <button id="popover-password" type="button" class="btn btn-success"
                                    data-container="body" data-toggle="popover" data-color="success"
                                    data-placement="top"
                                    data-content="Para que su contraseña sea fuerte, ingrese mayúsculas, números, carácteres especiales y que tenga una longitud mayor a 6 carácteres.">
                                    <span class="btn-inner--icon"><i class="ni ni-notification-70"></i></span>
                                </button>
                            </div>

                            {{-- <div class="row my-4">
                                <div class="col-12">
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        <input class="custom-control-input" id="customCheckRegister" type="checkbox">
                                        <label class="custom-control-label" for="customCheckRegister">
                                            <span class="text-muted">I agree with the <a href="#!">Privacy
                                                    Policy</a></span>
                                        </label>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-4">Registrarme</button>
                            </div>
                        </form>

                        {{-- * End form start --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('optional_scripts')
    <script src="{{ asset('assets/js/plugins/jquery-validator/jQueryValidator.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/select2/select2.min.js') }}"></script>

    <script src="{{ asset('assets/js/global/validatorMessages.js') }}"></script>

    <script src="{{ asset('assets/js/auth/register.js') }}" type="module"></script>
@endsection
