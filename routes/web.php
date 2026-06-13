<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;

Route::get('/dashboard',[ProdutoController::class, 'retornarQtdComidas'])->name('dashboard.retornarQtdComidas');
Route::get('/dashboard/produtos',[ProdutoController::class, 'produtos'])->name('dashboard.produtos');