<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
    	'session_id',
    	'status',
    	'usuario_id',
    	'cupom_id'
    ];

    public static function consultaPedido($sessionID){
    	$pedido = Self::where(['session_id' => $sessionID])->first(['id']);
    	return !empty($pedido->id) ? $pedido->id : null;
    }
}
