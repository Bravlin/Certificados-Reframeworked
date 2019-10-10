<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificado extends Model
{
    protected $table = 'certificado';
    protected $primaryKey = 'id_certificado';
    protected $guarded = ['fecha_emision'];

    public $timestamps = false;

    public static function juntada($columnasOrder = [], $where = [])
    {
        $res = self::join('inscripcion', 'certificado.fk_inscripcion', '=', 'inscripcion.id_inscripcion')
            ->join('evento', 'inscripcion.fk_evento', '=', 'evento.id_evento');
        if (!empty($where))
            $res->where($where);
        $res->select('certificado.id_certificado', 'certificado.fecha_emision', 'certificado.nombre_certificado', 'certificado.email_enviado',
            'inscripcion.tipo', 'inscripcion.fk_evento', 'inscripcion.fk_perfil',
            'evento.nombre as evento_nombre', 'inscripcion.nombre as perfil_nombre', 'inscripcion.apellido as perfil_apellido');
        foreach ($columnasOrder as $columna)
            $res->orderBy($columna);
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
