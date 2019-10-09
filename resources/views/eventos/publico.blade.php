@extends('publico')

@section('title', 'FICertif')

@section('head-particular')
    <link rel="stylesheet" type="text/css" href="/css/item-consulta.css">
@endsection

@section('contenido')
    <div class="container-fluid">
        <h1 class="mb-5 text-center">Eventos próximos</h1>

        <div class="row mb-5">
            @if (!$eventos->isEmpty())
                @foreach ($eventos as $evento)
                    @include('eventos.item_publico')
                @endforeach
            @endif
        </div>
    </div>
@endsection
