@extends('layouts.panel')

@section('titulo', 'Bienvenido | LHD')

@section('main')
    <div class="container-fluid">
        <h1 class="mt-4">E-mails</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Crear un E-mail</li>
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
        <div class="row m-0 p-0">
            
            <div class="col-12">
                <form action="{{route('storeemail')}}" method="post" class="was-validated">
                    @csrf
                    <div class="row p-0 m-0">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="destinatario">Destinatario</label>
                                <input type="text" class="form-control" id="destinatario" name="destinatario" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="subject">Asunto</label>
                                <input type="text" class="form-control" id="subject" name="subject" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="body">Mesaje</label>
                                <textarea class="form-control" id="body" name="body" rows="9" required></textarea>
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Enviar a Cola</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection