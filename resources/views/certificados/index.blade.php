@extends('layout')

@section('title', 'Certificados - FICertif')

@section('head-particular')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('contenido')
    <h1 class="mb-5 text-center">Certificados</h1>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-sm">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Evento</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Fecha de emisión</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Archivo</th>
                    <th scope="col"></th>
                </tr>
            </thead>

            <tbody id="body-certificados">
                @foreach ($certificados as $certificado)
                    <tr id="certificado-{{ $certificado->id_certificado }}">
                        <td>
                            <a href="{{ route('eventos.administrar', ['evento' => $certificado->fk_evento]) }}">
                                {{ $certificado->evento_nombre }}
                            </a>
                        </td>
                        <td>{{ $certificado->perfil_nombre }}</td>
                        <td>{{ $certificado->perfil_apellido }}</td>
                        <td>{{ $certificado->email_enviado }}</td>
                        <td>{{ date('Y-m-d', strtotime($certificado->fecha_emision)) }}</td>
                        <td>{{ $certificado->tipo }}</td>
                        <td><a href="{{ Storage::url('certificados/'.$certificado->nombre_certificado) }}">Ver</a></td>

                        <td>
                            <button class="eliminar-certificado btn btn-danger" valor="{{ $certificado->id_certificado }}">
                                Borrar
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('post-scripts')
    <script type="text/javascript" src="/js/manejador-certificados.js"></script>
@endsection
