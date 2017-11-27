<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servidor extends Model
{
    protected $primaryKey = 'idservidor';

    protected $fillable = [
        'servidor', 'matricula', 'tel', 'idcargo', 'idsetor' 
    ];

    public function cargo(){
    	return $this->belongsTo('App\Cargo', 'idcargo', 'idcargo');
    } 

    public function setor(){
    	return $this->belongsTo('App\Setor', 'idsetor', 'idsetor');
    } 

    public function destino(){
    	return $this->hasmany('App\Destino', 'idservidor', 'idservidor');
    }

    public function setServidorAttribute($value)
    {
        $this->attributes['servidor'] = mb_strtoupper($value);
    }


}
