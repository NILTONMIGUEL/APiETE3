@extends('layouts.app_layouts')
@section('conteudo')
    <!-- Main Content -->
    <main class="main-content">
        <header class="page-header">
            <button class="mobile-menu-btn" onclick="toggleSidebar()" aria-label="Menu">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div>
                <h1>Cadastrar Novo Produto</h1>
                <p>Preencha as informações abaixo para adicionar um item ao seu catálogo.</p>
            </div>
        </header>

        <form class="form-card" id="productForm" action="{{ route('dashboard.cadastrarProduto') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-grid">
                
                <!-- Coluna da Esquerda: Imagem -->
                <div>
                    <div class="form-group">
                        <label>Imagem do Produto <span class="required">*</span></label>
                        <div class="image-upload-area" id="dropZone" onclick="document.getElementById('imageInput').click()">
                            <input type="file" id="imageInput" accept="image/*" name="imagem" required>
                            
                            <div id="uploadPlaceholder">
                                <i class="fa-solid fa-cloud-arrow-up upload-icon"></i>
                                <div class="upload-text">Clique para enviar ou arraste a imagem</div>
                                <div class="upload-hint">PNG, JPG ou WEBP (Máx. 5MB)</div>
                            </div>
                            
                            <img id="imagePreview" alt="Preview do Produto" >

                            <button type="button" class="remove-image-btn" id="removeImageBtn" >
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Coluna da Direita: Dados -->
                <div>
                    <div class="form-group">
                        <label for="prodName">Nome do Produto <span class="required">*</span></label>
                        <input type="text" id="prodName" name="nome" class="form-control" placeholder="Ex: Pizza de Frango" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="prodCategory">Categoria <span class="required">*</span></label>
                            <select id="prodCategory" class="form-control" name="categoria" required>
                                <option value="" disabled selected>Selecione uma categoria</option>
                                <option value="1">Comidas</option>
                                <option value="2">Bebidas</option>
                                <option value="3">Sobremesas</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="prodPrice">Preço (R$) <span class="required">*</span></label>
                            <input type="text" id="prodPrice" class="form-control" placeholder="0,00" name="preco" required >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="prodDesc">Descrição Detalhada <span class="required">*</span></label>
                        <textarea id="prodDesc" name="descricao" class="form-control" placeholder="Descreva as características do seu produto..." required></textarea>
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
