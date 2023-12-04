@extends('company.layouts.main')

@section('title', 'Perfil')

@section('optional_links')
    {{-- <link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/select2.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/js/plugins/Choices/base.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/Choices/choices.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/sweetAlert/sweetAlert.min.css') }}">
@endsection

@section('content')
    <!-- Header -->
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center"
        style="min-height: 600px; background-image: url({{ asset('assets/img/theme/profile-cover.jpg') }}); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-lg-7 col-md-10">
                    <h1 class="display-2 text-white">Hola <div id="names_surnames"></div>
                    </h1>
                    <p class="text-white mt-0 mb-5">Esta es tu página de perfil. Puedes ver tu información registrada como
                        también puedes actualizarla.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                    <img src="{{ asset('assets/img/theme/farmacia.png') }}" class="rounded-circle">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-sm btn-info mr-4">Conectado</button>
                        </div>
                    </div>
                    <div class="card-body pt-md-4 pt-md-4">
                        <div class="mt-md-5 text-center">
                            <h3>
                                <span id="names_surnames-s" class="font-weight-light"></span> - <span id="document_number"
                                    class="font-weight-light"></span>
                            </h3>
                            <div class="h5 font-weight-300">
                                <i class="ni location_pin mr-2"></i> <span id="departament"></span>, <span
                                    id="province"></span> - <span id="district"></span>
                            </div>
                            <div>
                                <i class="ni education_hat mr-2"></i> <span id="address"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Mi cuenta</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- * FORM CHANGE DATES --}}

                        <form action="{{ route('profile.update-fields') }}" id="updateFieldsForm" method="POST"
                            data-send="{{ route('profile.edit') }}" autocomplete="off">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">Tú información</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label valid" for="input-username">Nombres y apellidos
                                                *</label>
                                            <input type="text" id="input-username" name="names_surnames"
                                                class="form-control form-control-alternative valid"
                                                placeholder="Ingresa los nombres y apellidos" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="select-document-type">Tipo de documento
                                                *</label>
                                            <select id="select-document-type"
                                                class="form-control js-example-basic-single input-form-class"
                                                name="document_type">
                                                @foreach ($documentTypes as $key => $type)
                                                    <option value="{{ $key }}"> {{ $type }} </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="document_number">Número de documento
                                                *</label>
                                            <input type="text" id="document_number" name="document_number"
                                                class="form-control form-control-alternative valid"
                                                placeholder="Ingresa el número de documento" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4" />
                            <!-- Address -->
                            <h6 class="heading-small text-muted mb-4">Información de contacto</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="select-departament">Departamento
                                                *</label>
                                            <select id="select-departament" class="form-control input-form-class"
                                                name="departament">
                                                @foreach ($departaments as $key => $departament)
                                                    <option value="{{ $key }}"> {{ $departament }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="select-province">Provincia *</label>
                                            <select id="select-province"
                                                class="form-control js-example-basic-single input-form-class"
                                                name="province">
                                                @foreach ($provinces as $key => $province)
                                                    <option value="{{ $key }}"> {{ $province }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="select-district">Distrito *</label>
                                            <select id="select-district"
                                                class="form-control js-example-basic-single input-form-class"
                                                name="district">
                                                @foreach ($districts as $key => $district)
                                                    <option value="{{ $key }}"> {{ $district }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="address">Dirección *</label>
                                            <input type="text" id="address" name="address"
                                                class="form-control form-control-alternative valid"
                                                placeholder="Ingresa la dirección" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="phone">Teléfono *</label>
                                            <input type="text" id="phone" name="phone"
                                                class="form-control form-control-alternative valid"
                                                placeholder="Ingrese su telefono celular" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="email">Correo *</label>
                                            <input type="text" id="email" name="email"
                                                class="form-control form-control-alternative valid"
                                                placeholder="Ingrese su correo" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-outline-primary mt-4 btn-save">Actualizar
                                    campos</button>
                            </div>
                            <hr class="my-4" />
                            <!-- Description -->
                        </form>
                        {{-- * FORM CHANGE PASSWORD --}}
                        <form id="updatePasswordForm" action="{{ route('profile.update-password') }}" method="POST"
                            data-validate="{{ route('profile.validatePassword') }}" autocomplete="off">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">Contraseña</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="password-now">Contraseña actual
                                                *</label>
                                            <input id="password-now" name="password_now"
                                                class="form-control form-control-alternative"
                                                placeholder="Ingrese su contraseña actual" type="password"
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="password">Nueva contraseña
                                                *</label>
                                            <input id="password" name="password"
                                                class="form-control form-control-alternative"
                                                placeholder="Ingrese su nueva contraseña" type="password">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="password-confirm">Repita su contraseña
                                                *</label>
                                            <input id="password-confirm" name="password_confirmation"
                                                class="form-control form-control-alternative"
                                                placeholder="Repita su contraseña" value="" type="password">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pl-lg-4">
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
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-outline-warning mt-4 btn-save">Actualizar
                                    contraseña</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('optional_scripts')
    <script src="{{ asset('assets/js/plugins/jquery-validator/jQueryValidator.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/plugins/select2/select2.min.js') }}"></script> --}}
    <script src="{{ asset('assets/js/plugins/Choices/choices.min.js') }}"></script>

    <script src="{{ asset('assets/js/plugins/sweetAlert/sweetAlert.min.js') }}"></script>

    <script src="{{ asset('assets/js/global/csrfToken.js') }}"></script>
    <script src="{{ asset('assets/js/global/validatorMessages.js') }}"></script>

    <script src="{{ asset('assets/js/profile/updatedFields.js') }}" type="module"></script>

    <script src="{{ asset('assets/js/profile/updatePassword.js') }}" type="module"></script>
@endsection
