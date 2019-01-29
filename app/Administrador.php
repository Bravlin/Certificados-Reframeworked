<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Administrador extends Authenticatable
{
    protected $table = 'administrador';
    protected $guard = 'administrador';
    protected $guarded = [];
    protected $hidden = ['password'];

    public $timestamps = false;
}
