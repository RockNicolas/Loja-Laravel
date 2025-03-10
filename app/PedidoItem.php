<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoItem extends Model
{
	protected $table = "pedidos_itens";

    protected $fillable = [
    	'pedido_id',
    	'valor',
    	'quantidade',
    	'produto_id'
    ];
}
