<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->string('nome');
            $table->decimal('preco', 10, 2)->default(0);
            $table->text('descricao');
            $table->string('imagem');
            $table->integer('marca_id');
            $table->timestamps();
            $table->foreign('marca_id')->references('id')->on(
                'marcas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}