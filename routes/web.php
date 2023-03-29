<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\Login\HomeController::class, 'index'])->name('Home.index');


Route::get('/Painel', [App\Http\Controllers\Painel\PainelController::class, 'index'])->name('Painel.index');

/* PRODUTO */
Route::get('/Painel/Produto', [App\Http\Controllers\Painel\Produtos\ProdutosController::class, 'index'])->name('Painel.Produto.index');
Route::post('/Painel/Produto', [App\Http\Controllers\Painel\Produtos\ProdutosController::class, 'store'])->name('Painel.Produto.store');
Route::put('/Painel/Produto', [App\Http\Controllers\Painel\Produtos\ProdutosController::class, 'update'])->name('Painel.Produto.update');
Route::delete('/Painel/Produto', [App\Http\Controllers\Painel\Produtos\ProdutosController::class, 'destroy'])->name('Painel.Produto.destroy');

/* ETAPAS */
Route::get('/Painel/Etapa', [App\Http\Controllers\Painel\Etapas\EtapasController::class, 'index'])->name('Painel.Etapa.index');
Route::post('/Painel/Etapa', [App\Http\Controllers\Painel\Etapas\EtapasController::class, 'store'])->name('Painel.Etapa.store');
Route::put('/Painel/Etapa', [App\Http\Controllers\Painel\Etapas\EtapasController::class, 'update'])->name('Painel.Etapa.update');
Route::delete('/Painel/Etapa', [App\Http\Controllers\Painel\Etapas\EtapasController::class, 'destroy'])->name('Painel.Etapa.destroy');

/*CAMPOS*/
Route::get('/Painel/Campo', [App\Http\Controllers\Painel\Campos\CamposController::class, 'index'])->name('Painel.Campo.index');
Route::post('/Painel/Campo', [App\Http\Controllers\Painel\Campos\CamposController::class, 'store'])->name('Painel.Campo.store');
Route::put('/Painel/Campo', [App\Http\Controllers\Painel\Campos\CamposController::class, 'update'])->name('Painel.Campo.update');
Route::delete('/Painel/Campo', [App\Http\Controllers\Painel\Campos\CamposController::class, 'destroy'])->name('Painel.Campo.destroy');

/*ITENS*/
Route::get('/Painel/Item/item={id}', [App\Http\Controllers\Painel\Itens\ItensController::class, 'index'])->name('Painel.Item.index');
Route::post('/Painel/Item/{id}', [App\Http\Controllers\Painel\Itens\ItensController::class, 'store'])->name('Painel.Item.store');
Route::put('/Painel/Item', [App\Http\Controllers\Painel\Itens\ItensController::class, 'update'])->name('Painel.Item.update');
Route::put('/Painel/Item/list={id}', [App\Http\Controllers\Painel\Itens\ItensController::class, 'updatesub'])->name('Painel.Item.updatesub');
Route::put('/Painel/Item/{id}', [App\Http\Controllers\Painel\Itens\ItensController::class, 'updateduplica'])->name('Painel.Item.updateduplica');
Route::get('/Painel/Item/SubItem/SubItem={id}', [App\Http\Controllers\Painel\Itens\ItensController::class, 'show'])->name('Painel.Item.sub-item.storesub');
Route::post('/Painel/Item', [App\Http\Controllers\Painel\Itens\ItensController::class, 'storesub'])->name('Painel.Item.storesub');

/*PEDIDDOS*/
Route::get('/Painel/Pedido', [App\Http\Controllers\Painel\Pedidos\PedidosController::class, 'index'])->name('Painel.Pedido.index');
Route::get('/Painel/Pedido/New/produto={id}', [App\Http\Controllers\Painel\Pedidos\PedidosController::class, 'show'])->name('Painel.Pedido.New.index');
Route::post('/Painel/Pedido', [App\Http\Controllers\Painel\Pedidos\PedidosController::class, 'store'])->name('Painel.Pedido.store');
Route::put('/Painel/Pedido', [App\Http\Controllers\Painel\Pedidos\PedidosController::class, 'update'])->name('Painel.Pedido.update');
Route::get('/Painel/Pedido/Realizados', [App\Http\Controllers\Painel\Pedidos\PedidosController::class, 'exibe'])->name('Painel.Pedido.Realizados.index');
Route::get('/Painel/Pedido/Visualizar/pedido={id}', [App\Http\Controllers\Painel\Pedidos\PedidosController::class, 'visualizar'])->name('Painel.Pedido.Visualizar.index');
Route::post('/Painel/Pedido/visualizar', [App\Http\Controllers\Painel\Pedidos\PedidosController::class, 'relacionar'])->name('Painel.Pedido.relacionar');

/* RELACIONAMENTO*/
Route::get('/Painel/Relacionamento', [App\Http\Controllers\Painel\Relacionamento\RelacionamentoController::class, 'index'])->name('Painel.Relacionamento.index');
Route::post('/Painel/Relacionamento', [App\Http\Controllers\Painel\Relacionamento\RelacionamentoController::class, 'produto'])->name('Painel.Relacionamento.produto');
Route::post('/Painel/Relacionamento/{id}', [App\Http\Controllers\Painel\Relacionamento\RelacionamentoController::class, 'etapa'])->name('Painel.Relacionamento.etapa');
Route::get('/Painel/Relacionamento/{id}', [App\Http\Controllers\Painel\Relacionamento\RelacionamentoController::class, 'campo'])->name('Painel.Relacionamento.campo');
Route::post('/Painel/Relacionamento/produto/{id}', [App\Http\Controllers\Painel\Relacionamento\RelacionamentoController::class, 'store'])->name('Painel.Relacionamento.store');

// USUARIOS
Route::get('/Painel/Usuarios', [App\Http\Controllers\Painel\Usuarios\UsuariosController::class, 'index'])->name('Painel.Usuarios.index');
Route::put('/Painel/Usuarios', [App\Http\Controllers\Painel\Usuarios\UsuariosController::class, 'update'])->name('Painel.Usuarios.update');

//SETORES
Route::get('/Painel/Setores', [App\Http\Controllers\Painel\Setores\SetoresController::class, 'index'])->name('Painel.Setores.index');
Route::post('/Painel/Setores', [App\Http\Controllers\Painel\Setores\SetoresController::class, 'store'])->name('Painel.Setores.store');
Route::put('/Painel/Setores', [App\Http\Controllers\Painel\Setores\SetoresController::class, 'update'])->name('Painel.Setores.update');
Route::post('/Painel/Setores/{relacionamento}', [App\Http\Controllers\Painel\Setores\SetoresController::class, 'create'])->name('Painel.Setores.create');
Route::put('/Painel/Setores/relacionamento={id}', [App\Http\Controllers\Painel\Setores\SetoresController::class, 'updaterel'])->name('Painel.Setores.updaterel');

//PRODUÇÃO
Route::get('/Painel/Producao', [App\Http\Controllers\Painel\Producao\ProducaoController::class, 'index'])->name('Painel.Producao.index');