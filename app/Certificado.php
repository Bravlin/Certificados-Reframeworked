<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificado extends Model
{
    protected $table = 'certificado';
    protected $primaryKey = 'id_certificado';
    protected $guarded = ['fecha_emision'];

    public $timestamps = false;

    public static function juntada($columnasOrdenamiento = [])
    {
        $res = self::join('inscripcion', 'certificado.fk_inscripcion', '=', 'inscripcion.id_inscripcion')
            ->join('evento', 'inscripcion.fk_evento', '=', 'evento.id_evento')
            ->join('perfil', 'inscripcion.fk_perfil', '=', 'perfil.id')
            ->select('certificado.id_certificado', 'certificado.fecha_emision', 'certificado.nombre_certificado', 'certificado.email_enviado',
                'inscripcion.tipo', 'inscripcion.fk_evento', 'inscripcion.fk_perfil',
                'evento.nombre as evento_nombre', 'perfil.nombre as perfil_nombre', 'perfil.apellido as perfil_apellido');
        foreach ($columnasOrdenamiento as $columna) {
            $res->orderBy($columna);
        }
        return $res->get();
    }

    public function inscripcion()
    {
        return $this->belongsTo('App\Inscripcion', 'fk_inscripcion', 'id_inscripcion');
    }

    public function fk_evento()
    {
        return $this->inscripcion->fk_evento;
    }

    public function evento()
    {
        return $this->inscripcion->evento;
    }

    public function fk_perfil()
    {
        return $this->inscripcion->fk_perfil;
    }

    public function perfil()
    {
        return $this->inscripcion->perfil;
    }
}