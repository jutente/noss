<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Historico extends Model
{
    protected $fillable = [
        'idservidor', 'idsetororigem', 'idsetordestino', 'dtmudanca', 'gerarelatorio'
    ];

    public function setor(){
    	return $this->belongsTo('App\Setor', 'idsetororigem', 'idsetor');
    } 

    public function setordestino(){
    	return $this->belongsTo('App\Setor', 'idsetordestino', 'idsetor');
    } 

    public function servidor(){
    	return $this->belongsTo('App\Servidor', 'idservidor', 'idservidor');
    } 
}
