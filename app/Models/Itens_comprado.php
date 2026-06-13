<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Itens_comprado extends Model
{
    // Define explicitamente o nome da tabela no banco
    protected $table = 'itens_comprados';

    // Campos reais da sua migration de itens_comprados
    protected $fillable = [
        'compra_id',
        'cliente',
        'produtos_id',
        'quantidade',
        'preco_unitario'
    ];
}