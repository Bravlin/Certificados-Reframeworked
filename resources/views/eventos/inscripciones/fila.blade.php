<tr id="inscripcion-{{ $inscripcion->id_inscripcion }}">
    <td>{{ $inscripcion->nombre }}</td>
    <td>{{ $inscripcion->apellido }}</td>
    <td>{{ $inscripcion->email }}</td>
    <td>{{ date('Y-m-d', strtotime($inscripcion->fecha_inscripcion)) }}</td>
    <td>{{ $inscripcion->tipo }}</td>

    <td>
        <select class="select-asistencia form-control" valor="{{ $inscripcion->id_inscripcion }}">
            <option value="-1" {{ $inscripcion->asistencia == -1 ? "selected" : ""}}>S/D</option>
            <option value="1" {{ $inscripcion->asistencia == 1 ? "selected" : ""}}>Sí</option>
            <option value="0" {{ $inscripcion->asistencia == 0 ? "selected" : ""}}>No</option>
    </td>

    <td>
        <a class="btn btn-primary" href="{{ route('perfiles.edit', $inscripcion->fk_perfil) }}">
            Modificar
        </a>
    </td>

    <td>
        <button id="emitir-i{{ $inscripcion->id_inscripcion }}" class="email-ind btn btn-success"
        valor="{{ $inscripcion->id_inscripcion }}" {{ $inscripcion->asistencia == 1 ? "" : "disabled"}}
        type="button" data-toggle="modal" data-target="#modal-mail">
            Enviar cert.
        </button>
    </td>

    <td>
        <button class="eliminar-inscripcion btn btn-danger" valor="{{ $inscripcion->id_inscripcion }}">
            Borrar
        </button>
    </td>
</tr>
