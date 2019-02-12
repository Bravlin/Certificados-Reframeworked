@extends('layout')

@section('title', 'Agregar varios - FICertif')

@section('head-particular')
    <link rel="stylesheet" type="text/css" href="/css/formulario.css">
@endsection

@section('contenido')
    <div class="form-container col-10 col-lg-8 py-5 px-1 px-sm-3 row justify-content-center mx-auto">
        <form class="formulario-principal color-blanco" method="POST" action="/perfiles/agregar-masivo" enctype="multipart/form-data">
            @csrf

            <h1 class="text-center">Agregar varios</h1>

            <div class="row cuerpo-form">
                <div class="col-sm-12 col-md-12 elemento-form">
                    <div class="custom-file">
                        <input name="csvFile" type="file" class="custom-file-input" id="customFile" required>
                        <label class="custom-file-label" for="customFile">Elija un Archivo CSV</label>
                    </div>
                </div>
            </div>

            <div class="row my-4">
                <div class="col-12 col-sm-4">
                    <select id="select-evento" name="evento" class="form-control" required>
                        <option value="">Elija un evento...</option>
                        @foreach ($eventos as $evento)
                            <option value="{{ $evento->id_evento }}">{{ $evento->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-sm-4">
                    <select id="select-tipo" name="tipo" class="form-control" required>
                        <option value="">Participa como...</option>
                        @foreach ($caracteres as $caracter)
                            <option value="{{ $caracter->caracter }}">{{ $caracter->caracter }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-sm-4">
                    <select id="select-asistencia" name="asistencia" class="form-control" required>
                        <option value="1">Presente</option>
                        <option value="0">Ausente</option>
                    </select>
                </div>
            </div>

            <div class="row justify-content-center mb-3">
                <button id="enviar" class="btn ficertifButton" type="submit">Enviar archivo</button>
            </div>
        </form>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p class="alerta col-12">{{ $error }}</p>
            @endforeach
        @endif
    </div>
@endsection
