<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrinho extends Model
{
    // Define o nome correto da tabela no banco
    protected $table = 'carrinho';

    // AUTORIZAÇÃO: Adicione esta propriedade para liberar as colunas
    protected $fillable = [
        'cliente',
        'produtos_id',
        'quantidade'
    ];

    // Relacionamento com o produto
    public function produto()
    {
        return $this->belongsTo(Produtos::class, 'produtos_id');
    }
}