<div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-5 d-flex align-items-stretch">
    <div class="card item-consulta">
        <div class="contenedor-portada">
            <a href="{{ route('eventos.administrar', ['evento' => $evento->id_evento]) }}">
                <img class="card-img-top" alt="Card image cap"
                    src=
                        @if (Storage::disk('public')->exists('media/portadas-eventos/'.$evento->id_evento.'-p'))
                            {!! '"'.Storage::url('media/portadas-eventos/'.$evento->id_evento.'-p').'"' !!}
                        @else
                            "/img/default-portada"
                        @endif
                >
            </a>

            <div class="contenedor-nombre px-4">
                <a class="enlace-evento" href="{{ route('eventos.administrar', ['evento' => $evento->id_evento]) }}">
                    <h5 class="card-title my-1">{{ $evento->nombre }}</h5>
                </a>
            </div>
        </div>

        <div class="card-body">
            <ul class="contenedor-info pl-0">
                <li class="mb-2">
                    <i class="fa fa-plus"></i>
                    {{ $evento->fecha_creacion }}
                </li>

                <li class="mb-2">
                    <i class="fa fa-map-marker ficertif-pink-text"></i>
                    {{ $evento->direccion_calle.' '.$evento->direccion_altura.', '.$evento->nombre_ciudad.', '.$evento->nombre_provincia }}
                </li>

                <li>
                    <i class="fa fa-calendar"></i>
                    {{ date('d/m/Y', strtotime($evento->fecha_realizacion)) }}
                    <i class="fa fa-clock-o pl-3"></i>
                    {{ date('H:i', strtotime($evento->fecha_realizacion)) }}
                </li>
            </ul>
        </div>
    </div>
</div>
