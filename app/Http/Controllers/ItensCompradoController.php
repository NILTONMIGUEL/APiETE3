<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ItensCompradoController extends Controller
{
    public function fecharCarrinho(Request $request)
    {
        // 1. Valida o ID do cliente enviado pelo Flutter
        $validator = Validator::make($request->all(), [
            'cliente' => 'required|integer', 
        ]);

        if ($validator->fails()) {
            return response()->json(['erro' => 'Cliente não informado.'], 400);
        }

        $clienteId = $request->input('cliente');

        // 2. Busca os itens do carrinho com o preço atual dos produtos
        $itensCarrinho = DB::table('carrinho')
            ->join('produtos', 'carrinho.produtos_id', '=', 'produtos.id')
            ->where('carrinho.cliente', $clienteId)
            ->select('carrinho.*', 'produtos.preco')
            ->get();

        if ($itensCarrinho->isEmpty()) {
            return response()->json(['erro' => 'O carrinho está vazio.'], 400);
        }

        try {
            // Usamos a Transaction para garantir consistência total no banco
            $resultadoCompraId = DB::transaction(function () use ($clienteId, $itensCarrinho) {
                
                // 3. Calcula o valor total geral da compra
                $totalCompra = $itensCarrinho->sum(function ($item) {
                    return $item->preco * $item->quantidade;
                });

                // 4. Cria a compra na tabela 'compras' (Gera o ID ÚNICO)
                $novoIdCompra = DB::table('compras')->insertGetId([
                    'cliente'    => $clienteId,
                    'total'      => $totalCompra,
                    'status'     => 1, 
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // 5. Mapeia os itens inserindo o 'compra_id' correto (Evitando conflito de nomes)
                $dadosItensComprados = $itensCarrinho->map(function ($item) use ($clienteId, $novoIdCompra) {
                    return [
                        'compra_id'      => $novoIdCompra, 
                        'cliente'        => $clienteId,
                        'produtos_id'    => $item->produtos_id,
                        'quantidade'     => $item->quantidade,
                        'preco_unitario' => $item->preco,
                        'created_at'     => now(),
                        'updated_at'     => now(),
                    ];
                })->values()->toArray();

                // 6. Insere os itens agrupados na tabela 'itens_comprados'
                DB::table('itens_comprados')->insert($dadosItensComprados);

                // 7. Limpa o carrinho do cliente
                DB::table('carrinho')->where('cliente', $clienteId)->delete();

                return $novoIdCompra;
            });

            return response()->json([
                'sucesso' => true,
                'mensagem' => 'Compra realizada com sucesso!',
                'compra_id' => $resultadoCompraId
            ], 201);

        } catch (\Throwable $e) { 
            // Captura qualquer erro de banco ou sintaxe e joga direto para o Flutter
            return response()->json([
                'sucesso' => false,
                'mensagem' => 'Erro interno ao processar a compra.',
                'erro_real' => $e->getMessage(), 
                'linha' => $e->getLine()
            ], 500);
        }
    }
}