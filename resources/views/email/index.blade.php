@extends('layouts.panel')

@section('titulo', 'Bienvenido | LHD')

@section('main')
    <div class="container-fluid">
        <h1 class="mt-4">E-mails</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Lista de corres electrónicos</li>
        </ol>

        <div class="row m-0 p-2 border border-dark">
            <div class="col-12 m-0 p-0">
                <a href="{{route('createemail')}}" class="btn btn-primary btn-lg btn-block">NUEVO CORREO</a>
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
                <h2 class='mb-3'>Tabla de Correos</h2>
                <table id="dataTable" class="table" width="100%">
                    <thead>
                        <tr>
                            @hasanyrole('admin')
                                <th class="th-sm">Remitente</th>
                            @endhasanyrole
                            <th class="th-sm">Destinatario</th>
                            <th class="th-sm">Asunto</th>
                            <th class="th-sm">Fecha Creado</th>
                            <th class="th-sm">Estado</th>
                            <th class="th-sm">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($emails as $aux)
                            <tr>
                                @hasanyrole('admin')
                                    <td class="p-0 m-0 align-middle">{{$aux->sender}}</td>
                                @endhasanyrole
                                <td class="p-0 m-0 align-middle">{{$aux->addressee}}</td>
                                <td class="p-0 m-0 align-middle">{{$aux->subject}}</td>
                                <td class="p-0 m-0 align-middle">{{$aux->shipping_date}}</td>
                                <td class="p-0 m-0 align-middle">{{$aux->status}}</td>
                                <td class="p-0 m-0 align-middle">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            @hasanyrole('admin')
                                <th>Remitente</th>
                            @endhasanyrole
                            <th>Destinatario</th>
                            <th>Asunto</th>
                            <th>Fecha Creado</th>
                            <th>Estado</th>
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