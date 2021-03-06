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
        return $this->belongsTo('App\Perfil', 'fk_perfil', 'id_perfil');
    }

    public function evento()
    {
        return $this->belongsTo('App\Evento', 'fk_evento', 'id_evento');
    }

    public function certificado()
    {
        return $this->hasOne('App\Certificado', 'fk_inscripcion', 'id_inscripcion');
    }

    public function asistio()
    {
        return $this->asistencia == Inscripcion::ASISTIO;
    }
}
