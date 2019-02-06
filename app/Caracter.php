<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caracter extends Model
{
    protected $table = 'caracter';
    protected $primaryKey = 'caracter';
    protected $fillable = [];

    public $timestamps = false;
    public $incrementing = false;
}
