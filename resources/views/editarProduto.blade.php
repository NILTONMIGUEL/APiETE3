@extends('layouts.app_layouts')
@section('conteudo')
    <!-- Main Content -->
    <main class="main-content">
        <header class="page-header">
            <button class="mobile-menu-btn" onclick="toggleSidebar()" aria-label="Menu">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div>
                <h1>Editar Produto</h1>
                <p>Preencha as informações abaixo para adicionar um item ao seu catálogo.</p>
            </div>
        </header>

        <form class="form-card" id="productForm" action="{{ route('dashboard.editarProduto', $produto->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-grid">
                
                <!-- Coluna da Esquerda: Imagem -->
                <div>
                    <div class="form-group">
                        <label>Imagem do Produto <span class="required">*</span></label>
                        <div class="image-upload-area" id="dropZone" onclick="document.getElementById('imageInput').click()">
                            <img src="{{asset('storage/'.$produto->imagem) }}" width="400px">
                        </div>
                    </div>
                </div>

                <!-- Coluna da Direita: Dados -->
                <div>
                    <div class="form-group">
                        <label for="prodName">Nome do Produto <span class="required">*</span></label>
                        <input type="text" id="prodName" name="nome" class="form-control" placeholder="Ex: Pizza de Frango"  value="{{$produto->nome}}">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="prodCategory">Categoria <span class="required">*</span></label>
                            @if($produto->categoria == 1)
                                <input id="prodCategory" class="form-control" value="Comidas" disabled> 
                                <input id="prodCategory" class="form-control" name="categoria" value="1" hidden> 
                            @elseif($produto->categoria == 2)
                                <input id="prodCategory" class="form-control"  value = "Bebidas" disabled> 
                                <input id="prodCategory" class="form-control" name="categoria" value = "2" hidden> 
                            @else
                                <input id="prodCategory" class="form-control"  value="Sobremesas" disabled>
                                <input id="prodCategory" class="form-control" name="categoria" value="3" hidden>
                            @endif
                              
                        </div>
                        <div class="form-group">
                            <label for="prodPrice">Preço (R$) <span class="required">*</span></label>
                            <input type="text" id="prodPrice" class="form-control" placeholder="0,00" name="preco" value="{{ $produto->preco }}" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="prodDesc">Descrição Detalhada <span class="required">*</span></label>
                        <textarea id="prodDesc" name="descricao" class="form-control" placeholder="{{ $produto->descricao }}" disabled></textarea>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('dashboard.produtos') }}" type="button" class="btn btn-secondary" style="text-decoration: none" >
                    <i class="fa-solid fa-arrow-left"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-primary" id="saveBtn">
                    <i class="fa-solid fa-save"></i> Salvar Produto
                </button>
            </div>
        </form>
    </main>

    <!-- Toast Notification -->
    <div class="toast" id="toast">
        <i class="fa-solid fa-circle-check"></i>
        <span id="toastMessage">Produto cadastrado com sucesso!</span>
    </div>
@endsection
