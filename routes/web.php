<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UserController;

Route::get('/dashboard',[ProdutoController::class, 'retornarQtdComidas'])->name('dashboard.retornarQtdComidas');
Route::get('/dashboard/produtos',[ProdutoController::class, 'produtos'])->name('dashboard.produtos');
Route::get('dashoboard/produtos/cadastrar-produtos',[ProdutoController::class, 'cadastrar'])->name('dashboard.cadastrar');
Route::post('dashoboard/produtos/cadastrar-produtos',[ProdutoController::class, 'cadastrarProduto'])->name('dashboard.cadastrarProduto');
Route::post('dashboard/produtos/cadastrar-produtos/{produto}',[ProdutoController::class , 'deletar'])->name('dashboard.deletar');
Route::get('dashboard/produtos/editar-produto/{produto}',[ProdutoController::class , 'editar'])->name('dashboard.editar');
Route::post('dashboard/produtos/editar-produto/{id}',[ProdutoController::class , 'editarProduto'])->name('dashboard.editarProduto');


Route::get('/dashboard/pedidos',[ProdutoController::class, 'pedidos'])->name('dashboard.pedidos');
Route::post('/dashboard/pedidos/{compra}',[ProdutoController::class, 'atualizar'])->name('dashboard.atualizar');
Route::post('dashoboard/pedidos-cancelar/{compra}',[ProdutoController::class, 'cancelar'])->name('dashboard.cancelar');

Route::get('/login',[UserController::class, 'loginView'])->name('user.loginView');
Route::post('/login',[UserController::class, 'login'])->name('user.login');


