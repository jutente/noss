<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    protected $fillable = [
        'descricao', 'numero', 'cnes', 'ine', 'unidade_id' 
    ];

    public function unidade(){
    	return $this->belongsTo('App\Unidade');
    }
}
