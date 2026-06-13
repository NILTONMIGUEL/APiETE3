<?php

namespace App\Http\Controllers;

use App\Models\Produtos;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Models\Compras;
use \Illuminate\Support\Number;

class ProdutoController extends Controller
{
    /**
     * Listar produtos paginados
     */
    public function index(Request $request)
    {
        $categoria = $request->categoria;

        $query = Produtos::query();

        if ($categoria) {
            $query->where('categoria', $categoria);
        }

        $produtos = $query->get();

        $produtos->transform(function ($produto) {
            $produto->imagem = asset('storage/' . $produto->imagem);
            return $produto;
        });

        return response()->json([
            'status' => 'Success',
            'produtos' => $produtos,
        ], Response::HTTP_OK);
    }

    /**
     * Buscar produto por ID
     */
    public function show($id)
    {
        $produto = Produtos::find($id);

        if (!$produto) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Produto não encontrado'
            ], Response::HTTP_NOT_FOUND);
        }

        $produto->imagem = asset('storage/' . $produto->imagem);

        return response()->json([
            'status' => 'Success',
            'produto' => $produto
        ], Response::HTTP_OK);
    }

    /**
     * Cadastrar produto
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'preco' => 'required|numeric',
            'categoria' => 'required|integer',
            'imagem' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $imagem = $request->file('imagem')->store(
            'produtos',
            'public'
        );

        $produto = Produtos::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'preco' => $request->preco,
            'categoria' => $request->categoria,
            'imagem' => $imagem,
        ]);

        $produto->imagem = asset('storage/' . $produto->imagem);

        return response()->json([
            'status' => 'Success',
            'message' => 'Produto cadastrado com sucesso',
            'produto' => $produto
        ], Response::HTTP_CREATED);
    }

    /**
     * Atualizar produto
     */
    public function update(Request $request, $id)
    {
        $produto = Produtos::find($id);

        if (!$produto) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Produto não encontrado'
            ], Response::HTTP_NOT_FOUND);
        }

        $request->validate([
            'nome' => 'sometimes|string|max:255',
            'descricao' => 'sometimes|string',
            'preco' => 'sometimes|numeric',
            'categoria' => 'sometimes|integer',
            'imagem' => 'sometimes|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        if ($request->hasFile('imagem')) {

            if (
                $produto->imagem &&
                Storage::disk('public')->exists($produto->imagem)
            ) {
                Storage::disk('public')->delete($produto->imagem);
            }

            $produto->imagem = $request
                ->file('imagem')
                ->store('produtos', 'public');
        }

        $produto->update([
            'nome' => $request->nome ?? $produto->nome,
            'descricao' => $request->descricao ?? $produto->descricao,
            'preco' => $request->preco ?? $produto->preco,
            'categoria' => $request->categoria ?? $produto->categoria,
            'imagem' => $produto->imagem,
        ]);

        $produto->imagem = asset('storage/' . $produto->imagem);

        return response()->json([
            'status' => 'Success',
            'message' => 'Produto atualizado com sucesso',
            'produto' => $produto
        ], Response::HTTP_OK);
    }

    /**
     * Excluir produto
     */
    public function destroy($id)
    {
        $produto = Produtos::find($id);

        if (!$produto) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Produto não encontrado'
            ], Response::HTTP_NOT_FOUND);
        }

        if (
            $produto->imagem &&
            Storage::disk('public')->exists($produto->imagem)
        ) {
            Storage::disk('public')->delete($produto->imagem);
        }

        $produto->delete();

        return response()->json([
            'status' => 'Success',
            'message' => 'Produto removido com sucesso'
        ], Response::HTTP_OK);
    }

    public function retornarQtdComidas(){
        $QTDProdutos = Produtos::count();
        $ProdutosRecente = Produtos::paginate(10);
        $ultimosProdutos = Produtos::orderBy('created_at', 'desc')->take(4)->get();
        $ultimasCompras = Compras::orderBy('created_at', 'desc')->take(4)->get();
        
        $qtdPedidos = Compras::count();
        $total = Compras::where('status', 2)->sum('total');


      
        $valorEmDolar = $total; 
        $valorEmReais = (float)$total;
        $valorFormatado = 'R$ ' . number_format($valorEmReais, 2, ',', '.');


        return view('conteudo',[
            'qtdProdutos' => $QTDProdutos,
            'ProdutosRecente' => $ProdutosRecente,
            'ultimosProdutos' => $ultimosProdutos,
            'ultimasCompras' => $ultimasCompras,
            'qtdPedidos' => $qtdPedidos,
            'total' => $valorFormatado
        ]);
    }

    public function produtos(){

        // $produtos = Produtos::paginate(10);
        $produtos = Produtos::all();
        
        return view('produtos',compact('produtos'));
    }
}