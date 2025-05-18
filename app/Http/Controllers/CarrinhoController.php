<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Produto;
use App\Pedido;
use App\PedidoItem;

class CarrinhoController extends Controller
{

	public function listar(){
		$sessionID = session()->getId();

		$IdPedido = Pedido::consultaPedido($sessionID);

		if (empty($IdPedido)){
			// Direcionar ele ou mostrar mensagem
		}

		$CarrinhoItens = DB::table("pedidos_itens")
						->join('produtos', 'pedidos_itens.produto_id', '=', 'produtos.id')
						->select('pedidos_itens.*', 'produtos.nome as produtoNome')
						->get();		

		return view('carrinho.carrinho')->with('carrinhoItens', $CarrinhoItens);
	}

	public function delete(){
		
		$sessionID = session()->getId();

		$IdPedido = Pedido::consultaPedido($sessionID);

		$request = Request();
		
		$request = produtos()
    	$produto_id = $request->input("produto_id");

		$produtoDelete = PedidoItem::where(['produto_id' => $produto_id, 'pedido_id' => $IdPedido])->first()->delete();

		return redirect()->route('carrinho.listar');
	}

	public function update(){
		
		$sessionID = session()->getId();

		$IdPedido = Pedido::consultaPedido($sessionID);

		$request = Request();
    	$produto_id = $request->input("produto_id");
    	$quantidade = $request->input("quantidade");

    	if ($quantidade > 0){
			$produtoAtualizar =  PedidoItem::where(['produto_id' => $produto_id, 'pedido_id' => $IdPedido])->first()->update(array('quantidade' => $quantidade));
		}
		return redirect()->route('carrinho.listar');
	}



    public function adicionar(){
    	$sessionID = session()->getId();

    	$request = Request();
    	$produto_id = $request->input("produto_id");
    	$quantidade = $request->input("quantidade");

    	$produto = Produto::find($produto_id);
    	
    	if (empty($produto->id)){
    		// Mensagem de Erro
    	}

    	$idPedido = Pedido::consultaPedido($sessionID);

    	if (empty($idPedido)){
    		Pedido::create([
	    		'session_id' => session()->getId(),
	    		'status' => 'C',
	    		'usuario_id' => 1,
	    		'cupom_id' => 1
    		]);

    		$idPedido = Pedido::consultaPedido($sessionID);
    	}

    	$produtoAddedBefore = PedidoItem::where(['produto_id' => $produto_id, 'pedido_id' => $idPedido])->first(['id', 'quantidade']);

    	if (empty($produtoAddedBefore->id)){
	    		PedidoItem::create([
		    		'pedido_id' => $idPedido,
		    		'valor' => $produto->price,
		    		'quantidade' => $quantidade,
		    		'produto_id' => $produto->id
	    		]);
    	} else {
    		$nova_quantidade = $quantidade + $produtoAddedBefore->quantidade;

    		PedidoItem::find($produtoAddedBefore->id)->update(array('quantidade' => $nova_quantidade));
    	}

    	return redirect()->route('carrinho.listar');
    	
    }
}
