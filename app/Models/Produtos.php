<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    //criando os dados que vai em massa para o store
    protected $fillable = [
        'nome',
        'descricao',
        'imagem',
        'preco',
        'categoria'
    ];
}
