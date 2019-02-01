<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    protected $table = 'ciudad';
    protected $primaryKey = 'id_ciudad';
    protected $fillable = [];

    public $timestamps = false;

    public function provincia()
    {
        return $this->belongsTo('App\Provincia', 'fk_provincia', 'id_provincia');
    }
}
