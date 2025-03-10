<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model 
{
    public function getPrecoAttribute($preco){
    	return $this->attributes["preco"] = sprintf("R$ %s", number_format($preco, 2, ',', '.') );	
    }

    public function getPriceAttribute($preco){
    	return $this->attributes["preco"];	
    }

    public function marca(){
    	return $this->BelongsTo("App\Marca");
    }
}
