<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'evento';
    protected $primaryKey = 'id_evento';
    protected $guarded = [];

    public $timestamps = false;

    public static function juntada($columnaOrdenamiento = 'id_evento', $secuencia = 'asc')
    {
        return self::join('ciudad', 'evento.fk_ciudad', '=', 'ciudad.id_ciudad')
            ->join('provincia', 'ciudad.fk_provincia', '=', 'provincia.id_provincia')
            ->select('evento.*', 'ciudad.nombre as nombre_ciudad', 'provincia.nombre as nombre_provincia')
            ->orderBy($columnaOrdenamiento, $secuencia)
            ->get();
    }
}