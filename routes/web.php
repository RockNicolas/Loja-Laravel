<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');
Route::get('/marcas/{id}', 'HomeController@marcas');

Route::get('/produto/{id}', 'HomeController@produto');
Route::get('/carrinho', 'CarrinhoController@listar')->name('carrinho.listar');
Route::post("/carrinho/adicionar", 'CarrinhoController@adicionar')->name('carrinho.adicionar');

Route::post("/carrinho/delete", 'CarrinhoController@delete')->name('carrinho.delete');

Route::post("/carrinho/update", 'CarrinhoController@update')->name('carrinho.update');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
