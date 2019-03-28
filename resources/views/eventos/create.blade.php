@extends('layout')

@section('title', 'Agregar evento - FICertif')

@section('head-particular')
    <link rel="stylesheet" type="text/css" href="/css/formulario.css">
@endsection

@section('contenido')
    <div class="form-container col-10 col-lg-8 py-5 px-1 px-sm-3 row justify-content-center mx-auto">
        <form class="formulario-principal color-blanco" method="POST" enctype="multipart/form-data" action="/eventos">
            @csrf

            <h1 class="text-center">Incorpora un evento</h1>

            <div class="row cuerpo-form">

                <div class="col-12 elemento-form">
                    <label for="nombre">Nombre del evento</label>
                    <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Mi evento"
                    value="{{ old('nombre') }}" required>

                    @if ($errors->has('nombre'))
                        <p class="alerta">El nombre no puede quedar vacío</p>
                    @endif
                </div>

                <div class="col-12 elemento-form">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion" type="text" class="form-control"
                    placeholder="Describa al evento...">{{old('descripcion') }}</textarea>
                </div>

                <div class="col-sm-12 col-md-6 elemento-form">
                    <label for="calle">Calle</label>
                    <input id="calle" name="direccion_calle" type="text" class="form-control" placeholder="Calle"
                    value="{{ old('direccion_calle') }}" required>

                    @if ($errors->has('direccion_calle'))
                        <p class="alerta">La calle no puede quedar vacía</p>
                    @endif
                </div>

                <div class="col-sm-12 col-md-6 elemento-form">
                    <label for="altura">Altura</label>
                    <input id="altura" name="direccion_altura" type="number" class="form-control" placeholder="123"
                    value="{{ old('direccion_altura') }}" required>

                    @if ($errors->has('direccion_altura'))
                        <p class="alerta">Altura inválida</p>
                    @endif
                </div>

                <div class="col-sm-12 col-md-6 elemento-form">
                    <label for="provincia">Provincia</label>
                    <select id="provincia" name="provincia" class="form-control" required>
                        <option value="">Elija una provincia...</option>
                        @foreach ($provincias as $provincia)
                            <option value='{{ $provincia->id_provincia }}'>{{ $provincia->nombre }}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('provincia'))
                        <p class="alerta">Ninguna provincia ha sido seleccionada</p>
                    @endif
                </div>

                <div class="col-sm-12 col-md-6 elemento-form">
                    <label for="ciudad">Ciudad</label>
                    <select id="ciudad" name="ciudad" class="form-control" required>
                        <option value="">Primero elija una provincia</option>
                    </select>

                    @if ($errors->has('ciudad'))
                        <p class="alerta">Ninguna ciudad ha sido seleccionada</p>
                    @endif
                </div>

                <div class="col-sm-12 col-md-6 elemento-form">
                    <label for="fechaReal">Fecha y hora de realización</label>
                    <input id="fechaReal" name="fecha_realizacion" type="datetime-local" class="form-control"
                    value="{{ old('fecha_realizacion') }}" required>

                    @if ($errors->has('fecha_realizacion'))
                        <p class="alerta">Ingrese una fecha válida</p>
                    @endif
                </div>

                <div class="col-sm-12 col-md-6 elemento-form">
                    <label for="portada">Portada</label>
                    <input id="portada" name="portada" type="file" class="form-control">

                    @if ($errors->has('portada'))
                        <p class="alerta">Archivo no válido.</p>
                    @endif
                </div>
            </div>

            <div class="row justify-content-center">
                <button class="btn ficertifButton" type="submit">Agregar</button>
            </div>
        </form>
    </div>
@endsection

@section('pos-scripts')
    <script type="text/javascript" src="/js/manejador-ciudades.js"></script>
@endsection
