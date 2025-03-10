<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status', ['C', 'A', 'P']);
            $table->integer('usuario_id');
            $table->integer('cupom_id');
             $table->text('session_id');
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('cupom_id')->references('id')->on('cupons');
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
        Schema::dropIfExists('pedidos');
    }
}
