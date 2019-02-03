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

@endsection

@section('post-scripts')
    <div id="id_evento" valor="{{ $evento->id_evento }}" hidden></div>
    <script type="text/javascript" src="/js/manejador-evento.js"></script>
    <script type="text/javascript" src="/js/manejador-ciudades.js"></script>
@endsection
