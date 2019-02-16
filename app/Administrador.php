<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Administrador extends Authenticatable
{
    protected $table = 'administrador';
    protected $guard = 'administrador';
    protected $primaryKey = 'id_administrador';
    protected $guarded = ['remember_token'];
    protected $hidden = ['password', 'remember_token'];

    public $timestamps = false;

    public function preferredLocale()
    {
        return 'es';
    }
}
