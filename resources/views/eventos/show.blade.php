@extends('publico')

@section('title', $evento->nombre.' - FICertif')

@section('head-particular')
    <link rel="stylesheet" type="text/css" href="/css/evento.css">
@endsection

@section('contenido')
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
@endsection
