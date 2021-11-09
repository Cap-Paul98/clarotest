@extends('layouts.panel')

@section('titulo', 'Bienvenido | LHD')

@section('main')
    <div class="container-fluid">
        <h1 class="mt-4">Usuarios</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Panel de usuarios del sistema</li>
        </ol>

        <div class="row m-0 p-2 border border-dark">
            <div class="col-12 m-0 p-0">
                <a href="{{route('createuser')}}" class="btn btn-primary btn-lg btn-block">AGREGAR NUEVO USUARIO</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="container-fluid">
            @if ($errors->any())
                <div class="alert alert-danger pb-0" role="alert">
                    <ol>
                        @foreach ($errors->all() as $error)
                            <li>@lang($error)</li>
                        @endforeach
                    </ol>
                </div>
            @endif
    
            @if (session()->has('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
    
            @if (session()->has('danger'))
                <div class="alert alert-danger">{{session('danger')}}</div>
            @endif
        </div>
    </div>

    <div class="container-fluid mt-4">
        <div class="row m-0 p-0">
            <div class="col-12">
                <h2 class='mb-3'>Tabla de Usuarios</h2>
                <table id="dataTable" class="table" width="100%">
                    <thead>
                        <tr>
                            <th class="th-sm">Nombre</th>
                            <th class="th-sm">Cédula</th>
                            <th class="th-sm">Correo</th>
                            <th class="th-sm">Celular</th>
                            <th class="th-sm">Edad</th>
                            <th class="th-sm">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $aux)
                            <tr>
                                <td class="p-0 m-0 align-middle">
                                    <span id="name{{$aux->id}}">{{$aux->name}}</span>
                                </td>
                                <td class="p-0 m-0 align-middle">{{$aux->userDate->nro_ci}}</td>
                                <td class="p-0 m-0 align-middle">{{$aux->email}}</td>
                                <td class="p-0 m-0 align-middle">{{$aux->userDate->cellphone}}</td>
                                <td class="p-0 m-0 align-middle">{{$aux->edad}}</td>
                                <td class="p-0 m-0 align-middle">
                                    @can('edit users')
                                        <a href="{{route('edituser', [$aux->id])}}" class="btn btn-success btn-sm m-1 py-2 px-3" data-toggle="tooltip" data-placement="top" title="Editar">
                                            <i class="fas fa-pen fa-2x"></i>
                                        </a>
                                    @endcan
                                    
                                    @can('delete users')
                                        <a href="#" class="btn btn-danger btn-sm m-1 py-2 px-3" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                            <i class="fas fa-trash-alt fa-2x"></i>
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nombre</th>
                            <th>Cédula</th>
                            <th>Correo</th>
                            <th>Celular</th>
                            <th>Edad</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
@endsection