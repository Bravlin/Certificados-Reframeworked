@extends('layout')

@section('title', 'Perfiles - FICertif')

@section('head-particular')
    <link rel="stylesheet" type="text/css" href="/css/item-perfil.css">

    <style>
        .agregar-perfil{
            color: var(--ing-verde);
            text-decoration: none;
            font-size: 1.75em;
        }

        .agregar-perfil:hover{
            color: var(--ing-azul);
            text-decoration: none;
        }
    </style>
@endsection

@section('contenido')
    <h1 class="mb-5 text-center">Administrador de perfiles</h1>

    <div class="row px-6">
        <div class="mb-6 col-sm">
            <a href="/perfiles/create" class="agregar-perfil">
                <i class="fa fa-plus-circle mr-1"></i>Agregar perfil
            </a>
            </div>
        <div class="mb-3 col-sm">
            <a href="agregar-varios.php" class="agregar-perfil">
                <i class="fa fa-plus-circle mr-1"></i>Agregar varios
            </a>
        </div>
    </div>

    @if (!$perfiles->isEmpty())
        <div id="perfiles" class="row px-2">
            @foreach ($perfiles as $perfil)
                <div id="perfil-{{ $perfil->id }}" class="col-12 col-lg-6 mb-5 px-0">
                    <div class="row item-perfil mx-auto border border-secondary">
                        <div class="col-12 col-sm-4 contenedor-imagen px-0 py-3 py-sm-0">
                            <a href="certificados.php?idPerfil={{ $perfil->id }}">
                                <img class="imagen-perfil" alt="Perfil"
                                    src="
                                        @if (file_exists('/media/perfiles-usuarios/' . $perfil->id . '-perfil'))
                                            /media/perfiles-usuarios/{{ $perfil->id }}-perfil
                                        @else
                                            /media/perfiles-usuarios/0-perfil
                                        @endif
                                    ">
                            </a>
                        </div>
                        <div class="col-12 col-sm-8 px-0 contenedor-info">
                            <div class="contenedor-nombre px-4">
                                <a class="nombre-apellido" href="certificados.php?idPerfil={{ $perfil->id }}">
                                    <h4 class="text-center">{{ $perfil->nombre }} {{ $perfil->apellido }}</h4>
                                </a>
                            </div>
                            <ul class="pl-0 mx-4">
                                <li><i class="fa fa-map-marker mr-1"></i>{{ $perfil->organismo }}</li>
                                <li><i class="fa fa-group mr-1"></i>{{ $perfil->cargo }}</li>
                                <li><i class="fa fa-envelope mr-1"></i>{{ $perfil->email }}</li>
                                <li><i class="fa fa-phone mr-1"></i>{{ $perfil->telefono }}</li>
                            </ul>
                            <a class="btn btn-primary ml-3 mb-3" href="/perfiles/{{ $perfil->id }}/edit">
                                Modificar
                            </a>
                            <button class="eliminar-perfil btn btn-danger ml-3 mb-3" valor="<?php echo $perfil['id']; ?>">
                                Eliminar
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection

@section('post-scripts')
    <script type="text/javascript" src="/js/manejador-perfil.js"></script>
@endsection
