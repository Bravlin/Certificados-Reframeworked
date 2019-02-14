<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    public const ASISTIO = 1;
    public const AUSENTE = 0;
    public const ASISTENCIA_SIN_DEFINIR = -1;

    protected $table = 'inscripcion';
    protected $primaryKey = 'id_inscripcion';
    protected $guarded = ['fecha_inscripcion'];

    public $timestamps = false;

    public function perfil()
    {
        return $this->belongsTo('App\Perfil', 'fk_perfil', 'id');
    }

    public function evento()
    {
        return $this->belongsTo('App\Evento', 'fk_evento', 'id_evento');
    }

    public function asistio()
    {
        $this->asistencia == Inscripcion::ASISTIO;
    }
}
