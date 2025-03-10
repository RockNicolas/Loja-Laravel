<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\Marca;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $produtos = Produto::all();

        $ultimo_produto = Produto::orderBy('created_at', 'desc')->first();

        $marcas = Marca::all()->sortBy("nome");

        return view('home.home')->with(["produtos"=> $produtos, "ultimo_produto" => $ultimo_produto, 'marcas' => $marcas]);
    }

    public function marcas($id)
    {
        $produtos = Produto::where(['marca_id' => $id])->get();

        $marcas = Marca::all()->sortBy("nome");

        return view('home.marcas')->with(["produtos"=> $produtos, 'marcas' => $marcas]);
    }

    public function produto($id)
    {
        $produto = Produto::where(['id' => $id])->first();
        
        if (empty($produto)){
            return redirect()->route("home");
        }

        return view('home.produto')->with("produto", $produto);
    }
}
