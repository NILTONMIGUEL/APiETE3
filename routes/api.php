<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\API\CarrinhoController;
use App\Http\Controllers\ItensCompradoController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/comidas', [ProdutoController::class , 'index']);
Route::post('/comidas', [ProdutoController::class , 'store']);
Route::delete('/comidas/{produtos}', [ProdutoController::class , 'destroy']);
// Rota que o Flutter vai chamar
Route::post('/carrinho/adicionar', [CarrinhoController::class, 'adicionar']);
// Rota para listar os itens do carrinho
Route::get('/carrinho', [CarrinhoController::class, 'listar']);
Route::post('/carrinho/atualizar', [CarrinhoController::class, 'atualizar']);
Route::post('/carrinho/remover', [CarrinhoController::class, 'remover']);
Route::post('/carrinho/comprar',[ItensCompradoController::class,'fecharCarrinho']);