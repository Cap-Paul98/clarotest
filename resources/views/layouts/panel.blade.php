<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('titulo')</title>

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="{{asset('css/app.css')}}"> --}}

    {{-- TEMA PANEL --}}
    <link rel="stylesheet" href="{{asset('panel/css/styles.css')}}">

    {{-- Fuentes --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">

    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body>
    
    <nav class="sb-topnav navbar navbar-expand navbar-dark black bg-dark">
        <a class="navbar-brand" href="{{route('home')}}">
            @switch($role)
                @case("admin")
                    ADMINISTRADOR
                    @break
                @case("user")
                    USUARIO
                    @break
            @endswitch
        </a>

        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#">
            <i class="fas fa-bars fa-2x"></i>
        </button>
        
        <div class="w-100"></div>

        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">Cambiar Contraseña</a>
                    {{-- <a class="dropdown-item" href="#">Activity Log</a> --}}
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark black" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Sistema</div>

                        <a class="nav-link" href="{{route('home')}}">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            Principal
                        </a>

                        @can('index users')
                            <a class="nav-link" href="{{route('users')}}">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                Usuarios
                            </a>
                        @endcan

                        @can('index email')
                            <a class="nav-link" href="#">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-inbox"></i>
                                </div>
                                E-mails
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Accediendo como:</div>
                    {{Auth()->user()->name}}
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main>
                @yield('main')
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-dark">Copyright © PJ 2021</div>
                        <div>
                            ·
                            <a href="https://www.pauljimenez.xyz/" target="_blank">
                                Info Dessarrollador Web
                            </a>
                            ·
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

    {{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('panel/assets/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('panel/assets/demo/chart-bar-demo.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('panel/assets/demo/datatables-demo.js')}}"></script>

    {{-- TEMA PANEL --}}
    <script type="text/javascript" src="{{asset('panel/js/scripts.js')}}"></script>

    {{-- Libre --}}
    @section('js')
    @show
</body>
</html>