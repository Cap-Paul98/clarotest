@extends('layouts.panel')

@section('titulo', 'Bienvenido | LHD')

@section('main')
    <div class="container-fluid">
        <h1 class="mt-4">Usuarios</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Editar Usuarios</li>
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

    <div class="container-fluid mt-4">
        <div class="row m-0 p-0 justify-content-center">
            <div class="col-sm-8">
                <form action="{{route('updateuser', [$user->id])}}" method="post" class="was-validated">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="id">ID</label>
                                <input type="text" class="form-control" id="id" value="{{$user->id}}" readonly>
                            </div>
                        </div>

                        <div class="col-sm-6 form-group">
                            <label for="role">Rol</label>
                            <select class="form-control" id="role" name="role">
                                @foreach ($roles as $aux)
                                    @if ($aux->name == $user->rol)
                                        <option value="{{$aux->name}}" selected>{{$aux->name}}</option>
                                    @else
                                        <option value="{{$aux->name}}">{{$aux->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" readonly required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="ci">Cédula de Identidad</label>
                                <input type="text" class="form-control" id="ci" name="ci" value="{{$user->userDate->nro_ci}}" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="cellphone">Teléfono</label>
                                <input type="text" class="form-control" id="cellphone" value="{{$user->userDate->cellphone}}" name="cellphone">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="date">Fecha Nacimeinto</label>
                                <input type="date" class="form-control" id="date" name="date" value="{{$user->userDate->birthday_date}}" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="code">Código de Ciudad</label>
                                <input type="text" class="form-control" id="code" name="code" value="{{$user->userDate->city_code}}" required>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="row p-0 m-0 border border-dark">
                                <div class="col-12 mt-2">
                                    <h6>¿Desea cambiar la contraseña?</h6>
                                </div>

                                <div class="col-12">
                                    <div class="alert alert-warning" role="alert">
                                        Si no desea, solo deje en blanco estos campos
                                    </div>
                                </div>
                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password">Contraseña</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirmar Contraseña</label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Guardar Datos</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection

@section('js')
@endsection