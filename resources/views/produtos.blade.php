@extends('layouts.app_layouts')
@section('conteudo')
    <!-- Main Content -->
    <main class="main-content">
        <header class="page-header">
            <div>
                <h1>Gerenciar Produtos</h1>
                <p style="color: var(--text-muted); font-size: 0.9rem; margin-top: 4px;">Visualize, adicione e gerencie seu catálogo de produtos.</p>
            </div>
            <button class="btn-primary" onclick="openModal()">
                <i class="fa-solid fa-plus"></i> Adicionar Novo Produto
            </button>
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
                                        <button class="btn-action btn-edit" title="Editar" onclick="editProduct('${p.id}')">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <button class="btn-action btn-delete" title="Excluir" onclick="deleteProduct('${p.id}')">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
    </main>

    <!-- Modal Adicionar/Editar Produto -->
    <div class="modal-overlay" id="productModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Adicionar Novo Produto</h2>
                <button class="btn-close" onclick="closeModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form id="productForm" onsubmit="handleFormSubmit(event)">
                <input type="hidden" id="productId">
                
                <div class="form-group">
                    <label>Nome do Produto</label>
                    <input type="text" class="form-control" id="prodName" required placeholder="Ex: Notebook Dell G15">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Categoria</label>
                        <select class="form-control" id="prodCategory" required>
                            <option value="Eletrônicos">Eletrônicos</option>
                            <option value="Acessórios">Acessórios</option>
                            <option value="Móveis">Móveis</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>URL da Imagem</label>
                        <input type="url" class="form-control" id="prodImage" placeholder="https://..." value="https://picsum.photos/seed/new/50/50">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Preço (R$)</label>
                        <input type="number" step="0.01" class="form-control" id="prodPrice" required placeholder="0.00">
                    </div>
                    <div class="form-group">
                        <label>Quantidade em Estoque</label>
                        <input type="number" class="form-control" id="prodStock" required placeholder="0">
                    </div>
                </div>

                <div class="form-group">
                    <label>Descrição</label>
                    <textarea class="form-control" id="prodDesc" rows="3" required placeholder="Breve descrição do produto..."></textarea>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-secondary" onclick="closeModal()">Cancelar</button>
                    <button type="submit" class="btn-primary"><i class="fa-solid fa-save"></i> Salvar Produto</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast" id="toast">
        <i class="fa-solid fa-circle-check"></i>
        <span id="toastMessage">Operação realizada com sucesso!</span>
    </div>

@endsection