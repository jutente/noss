<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerPage extends Model
{
    protected $fillable = [
        'valor', 'nome',
    ];
}
