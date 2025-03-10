@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-sm-3">
            <div class="card bg-light mb-3">
                <div class="card-header bg-primary text-white text-uppercase"><i class="fa fa-list"></i> Marcas</div>
                <ul class="list-group category_block">
                     @foreach($marcas as $marca)
                        <li class="list-group-item  @if ( Request()->id ==  $marca->id) active @endif"><a href="../../marcas/{{$marca->id}}">{{$marca->nome}}</a></li>
                    @endforeach
                   
                </ul>
            </div>
           
        </div>
        <div class="col">
            <div class="row">
                @foreach($produtos as $produto)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card">
                        <img class="card-img-top" src="../../imagens-produtos/{{$produto->imagem}}" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title"><a href="../../produto/{{$produto->id}}" title="View Product">{{$produto->nome}}</a></h4>
                            <p class="card-text">{{$produto->descricao}}</p>
                            <div class="row">
                                <div class="col">
                                    <p class="btn btn-danger btn-block"> {{$produto->preco}}</p>
                                </div>
                                <div class="col">
                                    <a href="#" class="btn btn-success btn-block">Adicionar Carrinho</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach   

                
            </div>
        </div>

    </div>
</div>
@endsection
