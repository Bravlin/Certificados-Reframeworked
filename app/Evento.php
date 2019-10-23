<?php

namespace App;

use App\Inscripcion;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'evento';
    protected $primaryKey = 'id_evento';
    protected $guarded = [];

    public $timestamps = false;

    public function categoria()
    {
        return $this->belongsTo('App\Categoria', 'fk_categoria', 'id_categoria');
    }

    public function ciudad()
    {
        return $this->belongsTo('App\Ciudad', 'fk_ciudad', 'id_ciudad');
    }

    public function fk_provincia()
    {
        return $this->ciudad->fk_provincia;
    }

    public function provincia()
    {
        return $this->ciudad->provincia;
    }

    public function inscripciones()
    {
        return $this->hasMany('App\Inscripcion', 'fk_evento', 'id_evento');
    }

    public function inscripcionesAsistentes()
    {
        return $this->inscripciones->where('asistencia', '=', Inscripcion::ASISTIO);
    }
}
