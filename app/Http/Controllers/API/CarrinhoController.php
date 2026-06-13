<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Carrinho;
use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    public function adicionar(Request $request)
    {
        $request->validate([
            'cliente' => 'required',
            'produto_id' => 'required',
            'quantidade' => 'required|integer|min:1',
        ]);

        $cliente     = (int) $request->input('cliente');
        $idDoProduto = (int) $request->input('produto_id');
        $quantidade  = (int) $request->input('quantidade');

        $itemExistente = Carrinho::where('produtos_id', $idDoProduto)
            ->where('cliente', $cliente)
            ->first();

        if ($itemExistente) {
            $itemExistente->quantidade += $quantidade;
            $itemExistente->save();
            
            return response()->json([
                'status' => 'sucesso',
                'mensagem' => 'Quantidade adicionada no carrinho!',
                'dados' => $itemExistente
            ], 200);
        }

        $novoItem = Carrinho::create([
            'cliente'     => $cliente,
            'produtos_id' => $idDoProduto, 
            'quantidade'  => $quantidade,
        ]);

        return response()->json([
            'status' => 'sucesso',
            'mensagem' => 'Produto adicionado ao carrinho com sucesso!',
            'dados' => $novoItem
        ], 201);
    }

    // 🆕 NOVO MÉTODO: Grava na marra a quantidade exata vinda do Flutter
    public function atualizar(Request $request)
    {
        $request->validate([
            'cliente' => 'required',
            'produto_id' => 'required',
            'quantidade' => 'required|integer|min:1',
        ]);

        $cliente     = (int) $request->input('cliente');
        $idDoProduto = (int) $request->input('produto_id');
        $novaQuantidade = (int) $request->input('quantidade');

        // Busca o item
        $item = Carrinho::where('produtos_id', $idDoProduto)
            ->where('cliente', $cliente)
            ->first();

        if ($item) {
            // Define exatamente a quantidade que ficou na tela do Flutter
            $item->quantidade = $novaQuantidade;
            $item->save();

            return response()->json([
                'status' => 'sucesso',
                'mensagem' => 'Quantidade fixada com sucesso!',
                'dados' => $item
            ], 200);
        }

        return response()->json([
            'status' => 'erro',
            'mensagem' => 'Item não encontrado no carrinho.'
        ], 404);
    }

    public function listar(Request $request)
    {
        // Captura o parâmetro 'cliente' (query string) ou tenta ler de um cabeçalho customizado se preferir
        $idCliente = $request->input('cliente') ?? $request->header('X-Cliente-Ficha') ?? 1;

        // Filtra no banco de dados apenas os itens da ficha/comanda atual
        $itensCarrinho = Carrinho::with('produto')
            ->where('cliente', $idCliente)
            ->get();

        $resultado = $itensCarrinho->map(function ($item) {
            return [
                'id_carrinho' => $item->id,
                'quantidade'  => $item->quantidade,
                'produto' => [
                    'id'        => $item->produto->id ?? null,
                    'nome'      => $item->produto->nome ?? 'Produto não encontrado',
                    'preco'     => $item->produto->preco ?? 0.00,
                    // Certifique-se de que a URL da imagem bata com a estrutura do seu storage público
                    'imagem'    => $item->produto->imagem ? asset('storage/' . $item->produto->imagem) : '',
                    'descricao' => $item->produto->descricao ?? '',
                ],
                // Garante que o cálculo do subtotal use valores numéricos limpos
                'subtotal' => $item->quantidade * (float)($item->produto->preco ?? 0)
            ];
        });

        $valorTotalCarrinho = $resultado->sum('subtotal');

        return response()->json([
            'status' => 'sucesso',
            'ficha_ativa' => (int)$idCliente, // Retorna para o Flutter confirmar qual ficha ele leu
            'total_carrinho' => $valorTotalCarrinho,
            'itens' => $resultado
        ], 200);
    }

    // Método atualizar com proteção para exclusão automática se chegar a 0

    // Método para o botão de lixeira (Excluir direto)
    public function remover(Request $request)
    {
        $request->validate([
            'cliente' => 'required',
            'produto_id' => 'required',
        ]);

        $cliente     = (int) $request->input('cliente');
        $idDoProduto = (int) $request->input('produto_id');

        $item = Carrinho::where('produtos_id', $idDoProduto)
            ->where('cliente', $cliente)
            ->first();

        if ($item) {
            $item->delete();
            return response()->json([
                'status' => 'sucesso',
                'mensagem' => 'Produto removido do carrinho com sucesso!'
            ], 200);
        }

        return response()->json([
            'status' => 'erro',
            'mensagem' => 'Item não encontrado.'
        ], 404);
    }
}