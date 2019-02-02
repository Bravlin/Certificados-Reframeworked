@if (!$ciudades->isEmpty())
    @foreach ($ciudades as $ciudad)
        <option value="{{ $ciudad->id_ciudad }}">{{ $ciudad->nombre }}</option>
    @endforeach
@else
    <option value="">Primero elija una provincia</option>
@endif
