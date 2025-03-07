<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidoItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos_itens', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->decimal('valor', 10, 2)->default(0);
            $table->integer('quantidade');
            $table->integer('produto_id');
            $table->integer('pedido_id');
            $table->foreign('produto_id')->references('id')->on('
                produtos');
            $table->foreign('pedido_id')->references('id')->on('
                pedidos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos_itens');
    }
}