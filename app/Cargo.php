<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $primaryKey = 'idcargo';

    protected $fillable = [
        'cargo', 'cbo'
    ];

    public function setCargoAttribute($value)
    {
        $this->attributes['cargo'] = mb_strtoupper($value);
    }
}
