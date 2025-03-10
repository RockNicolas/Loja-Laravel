@extends('layouts.app')

@section('content')

 <div class="container mb-4">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"> </th>
                            <th scope="col">Produto</th>
                            <th scope="col" class="text-center">Quantidade</th>
                            <th scope="col" class="text-right">Preço</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @php
                            $subtotal = 0;
                            $desconto = 10;
                            $total = 0;
                            $quantidade = 0;
                            Session::put("carrinho", 0);
                        @endphp

                        @foreach($carrinhoItens as $carrinhoItem) 
                         <form method="POST" action="{{ route('carrinho.update') }}">
                        {{ csrf_field() }} 

                        <tr>
                            <td><img src="https://dummyimage.com/50x50/55595c/fff" /> </td>
                            <td>{{$carrinhoItem->produtoNome}}</td>
                            <td><input name="quantidade" class="form-control" type="text" value="{{$carrinhoItem->quantidade}}" /><input type="hidden" name="produto_id" value="{{$carrinhoItem->produto_id}}"></form>  </td>
                            <td class="text-right">{{$carrinhoItem->valor}} / {{$carrinhoItem->valor*$carrinhoItem->quantidade}}</td>
                            <td class="text-right">
                        <form method="POST" action="{{ route('carrinho.delete') }}">
                            {{ csrf_field() }} 
                                <button type="submit" onclick="return confirm('Deseja realmente excluir do carrinho?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </button>
                                <input type="hidden" name="produto_id" value="{{$carrinhoItem->produto_id}}">
                              </form>   
                            </td>
                        </tr>
                    
                        @php
                            $subtotal += $carrinhoItem->valor * $carrinhoItem->quantidade;
                            $quantidade++;
                            Session::put("carrinho", $quantidade);
                        @endphp
                        @endforeach
                        @php
                            $total = $subtotal -  $desconto;
                        @endphp
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Sub-Total</td>
                            <td class="text-right">R$ {{ number_format ($subtotal, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Desconto</td>
                            <td class="text-right">R$ {{ number_format ($desconto, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Total</strong></td>
                            <td class="text-right"><strong>R$ {{ number_format ($total, 2, ',', '.') }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col mb-2">
            <div class="row">
                <div class="col-sm-12  col-md-6">
                    <button class="btn btn-block btn-light">Continue Shopping</button>
                </div>
                <div class="col-sm-12 col-md-6 text-right">
                    <button class="btn btn-lg btn-block btn-success text-uppercase">Checkout</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
