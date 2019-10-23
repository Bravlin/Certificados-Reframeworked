@extends('layout')

@section('title', 'Perfiles - FICertif')

@section('head-particular')
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
            <a href="{{ route('perfiles.create') }}" class="agregar-perfil">
                <i class="fa fa-plus-circle mr-1"></i>Agregar perfil
            </a>
            </div>
        <div class="mb-3 col-sm">
            <a href="/perfiles/agregar-masivo" class="agregar-perfil">
                <i class="fa fa-plus-circle mr-1"></i>Agregar varios
            </a>
        </div>
    </div>

    @if (!$perfiles->isEmpty())
        <div class="table-responsive">
            <table class="table table-striped table-hover table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Apellido</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Organismo</th>
                        <th scope="col">Cargo</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>

                <tbody id="body-perfiles">
                    @foreach ($perfiles as $perfil)
                        <tr id="perfil-{{ $perfil->id_perfil }}">
                            <td>{{ $perfil->apellido }}</td>
                            <td>{{ $perfil->nombre }}</td>
                            <td>{{ $perfil->email }}</td>
                            <td>{{ $perfil->telefono }}</td>
                            <td>{{ $perfil->organismo }}</td>
                            <td>{{ $perfil->cargo }}</td>
                            <td>
                                <a class="btn btn-primary ml-3 mb-3" href="{{ route('perfiles.edit', ['perfil' => $perfil->id_perfil]) }}">
                                    Modificar
                                </a>
                            </td>
                            <td>
                                <button class="eliminar-perfil btn btn-danger ml-3 mb-3" valor={{ $perfil->id_perfil }}>
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {!! $perfiles->render() !!}
    @endif
@endsection

@section('pos-scripts')
    <script type="text/javascript" src="/js/manejador-perfil.js"></script>
@endsection
