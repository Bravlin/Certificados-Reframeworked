@extends('publico')

@section('title', $evento->nombre.' - FICertif')

@section('head-particular')
    <link rel="stylesheet" type="text/css" href="/css/evento.css">
    <link rel="stylesheet" type="text/css" href="/css/formulario.css">
@endsection

@section('contenido')
    <div class="container-fluid">
        <h5 class="categoria">
            <i class="i-categoria fa fa-object-group"></i>
            {{ $evento->categoria->nombre }}
        </h5>

        <div class="contenedor-portada mb-5">
            <img class="portada" alt="portada"
            src=
                @if (Storage::disk('public')->exists('media/portadas-eventos/'.$evento->id_evento.'-p'))
                    {!! '"'.Storage::url('media/portadas-eventos/'.$evento->id_evento.'-p').'"' !!}
                @else
                    "/img/default-portada"
                @endif
            >

            <div class="contenedor-titulo px-1 px-md-3 text-center">{{ $evento->nombre }}</div>
        </div>

        <div class="info-general row py-3 my-5 mx-1">
            <div class="contenedor-nivel2 my-3 col-12 col-lg-6">
                <ul class="px-4" style="list-style-type: none;">
                    <li><i class="fa fa-calendar"></i> {{ date('d/m/Y', strtotime($evento->fecha_realizacion)) }}</li>
                    <li><i class="fa fa-clock-o"></i> {{ date('H:i', strtotime($evento->fecha_realizacion)) }}</li>
                    <li><i class="fa fa-map-marker"></i> {{ $evento->direccion_calle.' '.$evento->direccion_altura.', '.$evento->ciudad->nombre.', '.$evento->provincia()->nombre }}</li>
                </ul>

                <div class="contenedor-mapa mx-4">
                    <iframe class="mapa"
                        width="400"
                        height="350"
                        frameborder="0"
                        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBMTPQ8KW_7vtE_nChnfCgM-AsJTSbwQ1k&q={{ $evento->direccion_calle.' '.$evento->direccion_altura.', '.$evento->ciudad->nombre.', '.$evento->provincia()->nombre }}"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>

            <div class="col-12 col-lg-6 my-3 px-4">
                <h5>Descripción:</h5>
                <p>{{ $evento->descripcion }}</p>
            </div>
        </div>

        <div class="form-container py-5 px-1 px-sm-3 row justify-content-center mx-auto">
            <form class="formulario-principal color-blanco" method="POST" action="/perfiles" enctype="multipart/form-data">
                @csrf

                <h1 class="text-center">Inscripción</h1>

                <div class="row col-12 col-md-6 cuerpo-form justify-content-center mx-auto">
                    <div class="col-12 col-sm-6 elemento-form">
                        <label for="nombre">Nombre*</label>
                        <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Juan Martín"
                        value="{{ old('nombre') }}" required>

                        @if ($errors->has('nombre'))
                            <p class="alerta">El nombre no puede quedar vacío</p>
                        @endif
                    </div>

                    <div class="col-12 col-sm-6 elemento-form">
                        <label for="apellido">Apellido*</label>
                        <input id="apellido" name="apellido" type="text" class="form-control" placeholder="Pérez González"
                        value="{{ old('apellido') }}" required>

                        @if ($errors->has('apellido'))
                            <p class="alerta">El apellido no puede quedar vacío</p>
                        @endif
                    </div>

                    <div class="col-12 col-sm-6 elemento-form">
                        <label for="telefono">Teléfono*</label>
                        <input id="telefono" name="telefono" type="tel" class="form-control" placeholder="+54..."
                        value="{{ old('telefono') }}" required>

                        @if ($errors->has('telefono'))
                            <p class="alerta">Ingrese un teléfono válido.</p>
                        @endif
                    </div>

                    <div class="col-12 col-sm-6 elemento-form">
                        <label for="email">E-mail*</label>
                        <input id="email" name="email" type="email" class="form-control" placeholder="xxx@xxx.xxx"
                        value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <p class="alerta">El email es inválido o ya existe.</p>
                        @endif
                    </div>

                    <div class="col-12 col-sm-6 elemento-form">
                        <label for="organismo">Organismo*</label>
                        <input id="organismo" name="organismo" type="text" class="form-control" placeholder="Organismo"
                        value="{{ old('organismo') }}" required>

                        @if ($errors->has('organismo'))
                            <p class="alerta">Debe indicar un organismo.</p>
                        @endif
                    </div>

                    <div class="col-12 col-sm-6 elemento-form">
                        <label for="cargo">Cargo*</label>
                        <input id="cargo" name="cargo" type="text" class="form-control" placeholder="Cargo"
                        value="{{ old('cargo') }}" required>

                        @if ($errors->has('cargo'))
                            <p class="alerta">Debe indicar un cargo.</p>
                        @endif
                    </div>
                </div>

                <div class="row col-12 col-md-6 justify-content-center mx-auto">
                    <button id="enviar" class="btn ficertifButton" type="submit">Registrar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
