@extends('layout')

@section('title', 'Eventos - FICertif')

@section('head-particular')
    <link rel="stylesheet" type="text/css" href="/css/item-consulta.css">

    <style>
        .agregar-evento{
            color: var(--ing-verde);
            text-decoration: none;
            font-size: 1.75em;
        }

        .agregar-evento:hover{
            color: var(--ing-azul);
            text-decoration: none;
        }
    </style>
@endsection

@section('contenido')
    <h1 class="mb-5 text-center">Administrador de eventos</h1>

    <div class="mb-3">
        <a class="agregar-evento" href="/eventos/create" ><i class="fa fa-plus-circle mr-1"></i>Agregar evento</a>
    </div>

    @if (!$eventos->isEmpty())
        <div class="row">
            @foreach ($eventos as $evento)
                @include('eventos.item')
            @endforeach
        </div>
    @endif
@endsection
