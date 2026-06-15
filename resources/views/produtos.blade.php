@extends('layouts.app_layouts')
@section('conteudo')
    <!-- Main Content -->
    <main class="main-content">
        <header class="page-header">
            <div>
                <h1>Gerenciar Produtos</h1>
                <p style="color: var(--text-muted); font-size: 0.9rem; margin-top: 4px;">Visualize, adicione e gerencie seu catálogo de produtos.</p>
            </div>
            <a href="{{ route('dashboard.cadastrar') }}" class="btn-primary" style="text-decoration: none" >
                <i class="fa-solid fa-plus"></i> Adicionar Novo Produto
            </a>
        </header>
        <!-- Table -->
        <div class="table-card">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>ID</th>
                            <th>Categoria</th>
                            <th>Preço</th>
                            <th style="text-align: center;">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="products-table-body">
                        @foreach($produtos as $produto)
                            <tr>
                                <td>
                                    <div class="product-cell">
                                        <img src="{{ asset('storage/' .$produto->imagem) }}" alt="{{ $produto->nome }}"  width="100" height="50" style="object-fit: contain>
                                        <div>
                                            <span class="product-name">{{$produto->nome}}</span>
                                            <span class="product-desc">{{ $produto->descricao }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="product-id">{{ $produto->id }}</span></td>
                                @if($produto->categoria == 1)
                                    <td>COMIDAS</td>
                                @elseif($produto->categoria == 2)
                                    <td>BEBIDAS</td>
                                @else
                                    <td>SOBREMESAS</td>
                                @endif
                                <td style="font-weight: 700;">R$ {{ $produto->preco }}</td>
                                <td>
                                    <div class="action-btns" style="justify-content: center;">
                                        <form action="{{route('dashboard.editar', $produto->id)}}" method="get">   
                                            <button class="btn-action btn-edit" title="Editar">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>
                                        </form>  
                                        <form action="{{ route('dashboard.deletar', $produto->id) }}" method="post">
                                            @csrf
                                            <button class="btn-action btn-delete" title="Excluir" type="submit" >
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <!-- Toast Notification -->
    <div class="toast" id="toast">
        <i class="fa-solid fa-circle-check"></i>
        <span id="toastMessage">Operação realizada com sucesso!</span>
    </div>

@endsection