<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    protected $fillable = [
        'descricao', 'porte', 'logradouro', 'tel1', 'tel2', 'distrito_id' 
    ];

    public function distrito(){
    	return $this->belongsTo('App\Distrito');
    } 
}
