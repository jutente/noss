<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
    protected $primaryKey = 'idsetor';

    protected $fillable = [
        'setor','centrocusto'
    ];

    public function setSetorAttribute($value)
    {
        $this->attributes['setor'] = mb_strtoupper($value);
    }
}
