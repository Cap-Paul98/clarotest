@extends('layouts.panel')

@section('titulo', 'Bienvenido | LHD')

@section('main')
    <div class="container-fluid">
        <h1 class="mt-4">Bienvenido</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Panel administrativo</li>
        </ol>
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

    <div class="container-fluid mt-3">
        <div class="row m-0 px-2 py-4">
            <div class="col-sm-6">
                <strong >Nombre:</strong>
            </div>

            <div class="col-sm-6">
                <span >{{$user->name}}</span>
            </div>

            <div class="col-sm-6">
                <strong>E-mail:</strong>
            </div>

            <div class="col-sm-6">
                <span >{{$user->email}}</span>
            </div>

            <div class="col-sm-6">
                <strong>Nro. C.I:</strong>
            </div>

            <div class="col-sm-6">
                <span >{{$user->userDate->nro_ci}}</span>
            </div>

            <div class="col-sm-6">
                <strong>Código de Ciudad:</strong>
            </div>

            <div class="col-sm-6">
                <span >+ {{$user->userDate->city_code}}</span>
            </div>

            <div class="col-sm-6">
                <strong>Teléfono:</strong>
            </div>

            <div class="col-sm-6">
                <span >{{$user->userDate->cellphone}}</span>
            </div>

            <div class="col-sm-6">
                <strong>Fecha Nac.:</strong>
            </div>

            <div class="col-sm-6">
                <span >{{$user->userDate->birthday_date}}</span>
            </div>
            
            <div class="col-sm-6">
                <strong>País:</strong>
            </div>
            
            <div class="col-sm-6">
                <span >{{$user_country->country}}</span>
            </div>
            
            <div class="col-sm-6">
                <strong>Estado:</strong>
            </div>
            
            <div class="col-sm-6">
                <span >{{$user_country->state}}</span>
            </div>
            
            <div class="col-sm-6">
                <strong>Ciudad:</strong>
            </div>
            
            <div class="col-sm-6">
                <span >{{$user_country->city}}</span>
            </div>
        </div>
    </div>
@endsection