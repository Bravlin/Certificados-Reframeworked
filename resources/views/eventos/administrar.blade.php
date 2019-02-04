@extends('layout')

@section('title', $evento->nombre.' - FICertif')

@section('head-particular')
    <link rel="stylesheet" type="text/css" href="/css/evento.css">
    <link rel="stylesheet" type="text/css" href="/css/edicion-evento.css">
    <link rel="stylesheet" type="text/css" href="/css/comentario.css">

    <style>
        .alerta{
            color: red;
        }
    </style>
@endsection

@section('contenido')
    <form method="POST" enctype="multipart/form-data" action="{{ route('eventos.update', $evento->id_evento) }}">
        @csrf
        @method('PATCH')

        <div class="contenedor-portada mb-5">
            <img class="portada" alt="portada"
                src=
                    @if (Storage::disk('public')->exists('media/portadas-eventos/'.$evento->id_evento.'-p'))
                        {!! '"'.Storage::url('media/portadas-eventos/'.$evento->id_evento.'-p').'"' !!}
                    @else
                        {!! '"'.Storage::url('media/portadas-eventos/0-p').'"' !!}
                    @endif
            >

            <div class="contenedor-titulo px-1 px-md-3">
                <input id="nombre" name="nombre" type="text" class="editable ed-nombre text-center"
                value="{{ old('nombre', $evento->nombre)}}" required>
            </div>

            @if ($errors->has('nombre'))
                <p class="alerta">El nombre no puede quedar vacío</p>
            @endif
        </div>

        <h5>Descripción:</h5>

        <textarea id="descripcion" name="descripcion" class="editable ed-descripcion">{{ old('descripcion', $evento->descripcion) }}</textarea>

        <div class="info-general row py-3 my-5">
            <div class="col-12 col-lg-6 mb-3 mb-sm-0 row">
                <div class="col-12 elemento-form mb-3">
                        <label for="fechaReal"><i class="fa fa-calendar"></i> Fecha y <i class="fa fa-clock-o"></i> hora</label>
                        <input id="fechaReal" name="fecha_realizacion" type="datetime-local" class="form-control"
                        value="{{ old('fecha_realizacion', date('Y-m-d\TH:i', strtotime($evento->fecha_realizacion))) }}" required>

                        @if ($errors->has('fecha_realizacion'))
                            <p class="alerta">Ingrese una fecha válida</p>
                        @endif
                </div>

                <div class="col-12 mb-2">
                    <i class="fa fa-map-marker"></i> Ubicación
                </div>

                <div class="col-sm-6 elemento-form mb-2">
                    <label for="calle">Calle</label>
                    <input id="calle" name="direccion_calle" type="text" class="form-control"
                    value="{{ old('direccion_calle', $evento->direccion_calle) }}" required>

                    @if ($errors->has('direccion_calle'))
                        <p class="alerta">La calle no puede quedar vacía</p>
                    @endif
                </div>

                <div class="col-sm-6 elemento-form mb-2">
                    <label for="altura">Altura</label>
                    <input id="altura" name="direccion_altura" type="number" class="form-control"
                    value="{{ old('direccion_altura', $evento->direccion_altura) }}" required>

                    @if ($errors->has('direccion_altura'))
                        <p class="alerta">Altura inválida</p>
                    @endif
                </div>

                <div class="col-sm-6 elemento-form mb-2">
                    <label for="provincia">Provincia</label>
                    <select id="provincia" name="provincia" class="form-control" required>
                        @foreach ($provincias as $provincia)
                            <option value="{{ $provincia->id_provincia }}"
                            {{ $provincia->id_provincia == old('provincia', $evento->fk_provincia()) ? 'selected' : '' }}
                            >{{ $provincia->nombre }}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('provincia'))
                        <p class="alerta">Ninguna provincia ha sido seleccionada</p>
                    @endif
                </div>

                <div class="col-sm-6 elemento-form mb-2">
                    <label for="ciudad">Ciudad</label>
                    <select id="ciudad" name="ciudad" class="form-control" required>
                        @foreach ($provincias->firstWhere('id_provincia', old('provincia', $evento->fk_provincia()))->ciudades as $ciudad)
                            <option value="{{ $ciudad->id_ciudad }}"
                            {{ $ciudad->id_ciudad == old('ciudad', $evento->fk_ciudad) ? 'selected' : '' }}
                            >{{ $ciudad->nombre }}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('ciudad'))
                        <p class="alerta">Ninguna ciudad ha sido seleccionada</p>
                    @endif
                </div>

                <div class="text-center my-auto mx-auto">
                    <div class="mt-3">
                        <button class="btn btn-primary" type="submit">Modificar</button>

                        <button id="eliminar-evento" class="btn btn-danger ml-3">Eliminar</button>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6 d-flex flex-column">
                <div class="contenedor-nivel2 mt-3 col-12">
                    <div class="contenedor-mapa">
                        <iframe class="mapa"
                            width="400"
                            height="350"
                            frameborder="0"
                            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBMTPQ8KW_7vtE_nChnfCgM-AsJTSbwQ1k&q={{ $evento->direccion_calle.' '.$evento->direccion_altura.', '.$evento->ciudad->nombre.', '.$evento->provincia()->nombre }}"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('post-scripts')
    <div id="id_evento" valor="{{ $evento->id_evento }}" hidden></div>
    <script type="text/javascript" src="/js/manejador-evento.js"></script>
    <script type="text/javascript" src="/js/manejador-ciudades.js"></script>
@endsection
