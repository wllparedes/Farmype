<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
            aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('company.home') }}">
            <img src="{{ asset('assets/img/icons/farmype.jpg') }}" class="navbar-brand-img" alt="">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="ni ni-bell-55"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right"
                    aria-labelledby="navbar-default_dropdown_1">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('assets/img/theme/farmacia.png') }}">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Bienvenido!</h6>
                    </div>
                    <a href="{{ route('profile.index') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>Mi perfil</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item"
                        onclick="event.preventDefault(); document.getElementById('logout-form-sb').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>Salir</span>
                        <form id="logout-form-sb" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('company.home') }}">
                            <img src="{{ asset('assets/img/icons/farmype.jpg') }}">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                            data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                            aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended"
                        placeholder="Buscar" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item  {{ setActive('company.home') }} ">
                    <a class="nav-link  {{ setActive('company.home') }} " href="{{ route('company.home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> Home
                    </a>
                </li>
                <li class="nav-item {{ setActive('profile.index') }}">
                    <a class="nav-link {{ setActive('profile.index') }}" href="{{ route('profile.index') }}">
                        <i class="ni ni-single-02 text-yellow"></i> Perfil de Usuario
                    </a>
                </li>
                <li class="nav-item {{ setActive('company.inventory.create') }}">
                    <a class="nav-link {{ setActive('company.inventory.create') }}"
                        href="{{ route('company.inventory.create') }}">
                        <i class="ni ni-settings-gear-65 text-blue"></i> Registro de inventarios
                    </a>
                </li>
                <li class="nav-item {{ setActive('company.promotions.list') }}">
                    <a class="nav-link {{ setActive('company.promotions.list') }}"
                        href="{{ route('company.promotions.list') }}">
                        <i class="ni ni-app text-info"></i> Promociones
                    </a>
                </li>
                <li class="nav-item {{ setActive('company.inventory.index') }}">
                    <a class="nav-link {{ setActive('company.inventory.index') }}"
                        href="{{ route('company.inventory.index') }}">
                        <i class="ni ni-box-2 text-orange"></i> Consultar inventario
                    </a>
                </li>
                <li class="nav-item {{ setActive('company.sales.index') }}">
                    <a class="nav-link {{ setActive('company.sales.index') }}"
                        href="{{ route('company.sales.index') }}">
                        <i class="ni ni-bullet-list-67 text-pink"></i> Ordenes de ventas
                    </a>
                </li>
                {{-- <li class="nav-item ">
                    <a class="nav-link" href="{{ route('profile.index') }}">
                        <i class="ni ni-key-25 text-info"></i> Perfil
                    </a>
                </li> --}}
                {{-- <li class="nav-item ">
                    <a class="nav-link" href="./examples/register.html">
                        <i class="ni ni-circle-08 text-pink"></i> Register
                    </a>
                </li> --}}
            </ul>
            <!-- Divider -->
            <hr class="my-3">
            <!-- Heading -->
            {{-- <h6 class="navbar-heading text-muted">Documentation</h6> --}}
            <!-- Navigation -->
            {{-- <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link"
                        href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html">
                        <i class="ni ni-spaceship"></i> Getting started
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html">
                        <i class="ni ni-palette"></i> Foundation
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="https://demos.creative-tim.com/argon-dashboard/docs/components/alerts.html">
                        <i class="ni ni-ui-04"></i> Components
                    </a>
                </li>
            </ul> --}}
            {{-- <ul class="navbar-nav">
                <li class="nav-item active active-pro">
                    <a class="nav-link" href="./examples/upgrade.html">
                        <i class="ni ni-send text-dark"></i> Upgrade to PRO
                    </a>
                </li>
            </ul> --}}
        </div>
    </div>
</nav>
