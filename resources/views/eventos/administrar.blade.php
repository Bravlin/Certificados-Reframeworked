@extends('layout')

@section('title', $evento->nombre.' - FICertif')

@section('head-particular')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" type="text/css" href="/css/evento.css">
    <link rel="stylesheet" type="text/css" href="/css/edicion-evento.css">

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

        <div>
            <i class="i-categoria fa fa-object-group"></i>
            <select id="categoria" name="categoria" class="editable ed-categoria" required>
                @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id_categoria }}"
                    {{ $categoria->id_categoria == old('categoria', $evento->fk_categoria) ? 'selected' : '' }}
                >{{ $categoria->nombre }}</option>
                @endforeach

                @if ($errors->has('categoria'))
                    <p class="alerta">Ninguna categoría ha sido seleccionada</p>
                @endif
            </select>
        </div>

        <div class="contenedor-portada mb-5">
            <img class="portada" alt="portada"
                src=
                    @if (Storage::disk('public')->exists('media/portadas-eventos/'.$evento->id_evento.'-p'))
                        {!! '"'.Storage::url('media/portadas-eventos/'.$evento->id_evento.'-p').'"' !!}
                    @else
                        "/img/default-portada"
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

    <h3 class="mb-3">Certificados</h3>

    <label for="template">Template de certificado</label>
    <div class="row">
        <div class="col-12 col-sm-8">
            <input id="template" name="template" type="file" class="form-control">
        </div>

        <div class="col-12 col-sm-4 align-self-center">
            <button id="subir-template" class="mt-2 mt-sm-0 btn ficertifButton" type="button">Subir</button>
        </div>
    </div>

    <div class="my-4">
        <button id="generar-todos" class="btn btn-primary mb-2" type="button">Generar todos</button>
        <button id="email-todos" class="btn btn-success ml-0 ml-sm-2 mb-2" type="button"  data-toggle="modal" data-target="#modal-mail">Email a todos</button>
        <a class="btn btn-secondary ml-0 ml-sm-2 mb-2" href="{{ route('eventos.certificados', $evento->id_evento) }}">
            Consultar
        </a>
    </div>

    <h3 class="mb-4">Inscripciones</h3>

    <div class="row my-4">
        <div class="col-12 col-sm-4">
            <select id="select-perfil" class="form-control" required>
                <option value="">Elija a quien inscribir...</option>
                @foreach ($perfiles as $perfil)
                    <option value="{{ $perfil->id }}">{{ $perfil->nombre.' '.$perfil->apellido.' - '.$perfil->email}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12 col-sm-4 mt-3 mt-sm-0">
            <select id="select-tipo" class="form-control" required>
                <option value="">Participa como...</option>
                @foreach ($caracteres as $caracter)
                    <option value="{{ $caracter->caracter }}">{{ $caracter->caracter }}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-3 mt-sm-0 col-sm-4">
            <button id="boton-inscribir" class="btn btn-primary" type="button" disabled>Inscribir</button>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-sm">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Fecha de inscripción</th>
                    <th scope="col">Participación</th>
                    <th scope="col">Asistencia</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>

            <tbody id="body-inscripciones">
                @foreach (
                    $evento->inscripciones()
                    ->join('perfil', 'inscripcion.fk_perfil', 'perfil.id')
                    ->select('inscripcion.*', 'perfil.nombre', 'perfil.apellido', 'perfil.email')
                    ->orderBy('nombre')
                    ->get() as $inscripcion
                )
                    @include('eventos.inscripciones.fila')
                @endforeach
            </tbody>
        </table>
    </div>

    <div id="modal-mail" class="modal fade contenedor-modal" tabindex="-1" role="dialog" aria-labelledby="modal-mail" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Enviar certificados</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="form-mail" class="modal-body">
                    <div class="row cuerpo-form">
                        <div class="col-12 elemento-form mb-2">
                            <label for="remitente">Remitente</label>
                            <input id="remitente" name="remitente" type="email" class="form-control" placeholder="direccion@correo.com" required>
                        </div>

                        <div class="col-12 elemento-form mb-2">
                            <label for="asunto">Asunto</label>
                            <input id="asunto" name="asunto" type="text" class="form-control" placeholder="Asunto" required>
                        </div>

                        <div class="col-12 elemento-form mb-2">
                            <label for="cuerpo-mail">Mensaje</label>
                            <textarea id="cuerpo-mail" name="cuerpo_mail" type="text" class="form-control" placeholder="Cuerpo del mensaje..." required></textarea>
                        </div>
                    </div>

                    <div class="row justify-content-center mt-2">
                        <button id="emitir-todos" class="btn ficertifButton envioMail" type="submit" hidden>Emitir a todos</button>

                        <button id="emitir-uno" class="btn ficertifButton envioMail" type="submit" hidden>Emitir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('pos-scripts')
    <div id="id_evento" valor="{{ $evento->id_evento }}" hidden></div>
    <script type="text/javascript" src="/js/manejador-evento.js"></script>
    <script type="text/javascript" src="/js/manejador-ciudades.js"></script>
@endsection
