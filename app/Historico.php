<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    protected $fillable = [
        'idservidor', 'idsetororigem', 'idsetordestino', 'dtmudanca'
    ];
}
