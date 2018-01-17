<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destino extends Model
{
    protected $primaryKey = 'iddestino';
    
    protected $fillable = [
        'idservidor', 'idsetor', 'dtcadastro', 'protocolo'
    ];
   
    public function servidor(){
    	return $this->belongsTo('App\Servidor', 'idservidor', 'idservidor');
    } 

   /*  public function setDestinoAttribute($value)
    {
        $this->attributes['setor'] = mb_strtoupper($value);
    } */

    public function setor(){
    	return $this->belongsTo('App\Setor', 'idsetor', 'idsetor');
    }
}
