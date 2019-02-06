<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
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
}
