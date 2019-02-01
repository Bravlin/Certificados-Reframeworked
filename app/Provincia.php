<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    protected $table = 'provincia';
    protected $primaryKey = 'id_provincia';
    protected $fillable = [];

    public $timestamps = false;

    public function ciudades()
    {
        return $this->hasMany('App\Ciudad', 'fk_provincia');
    }
}
