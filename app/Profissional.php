<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profissional extends Model
{
    protected $fillable = [
        'nome', 'porte', 'matricula', 'admissao', 'observacao', 'cpf', 'cartaosus', 'cargaHoraria_id', 'cargo_id', 'vinculo_id', 'vinculoTipo_id'
    ];

    public function cargaHoraria(){
    	return $this->belongsTo('App\CargaHoraria');
    }

    public function cargo(){
    	return $this->belongsTo('App\Cargo');
    }

    public function vinculo(){
    	return $this->belongsTo('App\Vinculo');
    }

    public function vinculoTipo(){
    	return $this->belongsTo('App\VinculoTipo');
    }
}
