 @extends('layouts.app_layouts')
 @section('conteudo')
 <!-- Main Content -->
    <main class="main-content">
        <header class="header">
            <div style="display: flex; align-items: center;">
                <i class="fa-solid fa-bars mobile-menu-btn" onclick="toggleSidebar()"></i>
                <h1>Dashboard</h1>
            </div>
            <div class="user-profile">
                <span>Olá, Admin</span>
                <div class="user-avatar">A</div>
            </div>
        </header>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon icon-products">
                    <i class="fa-solid fa-cubes"></i>
                </div>
                <div class="stat-info">
                    <h3>Total de Produtos</h3>
                    <div class="value">{{$qtdProdutos}}</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon icon-orders">
                    <i class="fa-solid fa-bag-shopping"></i>
                </div>
                <div class="stat-info">
                    <h3>Pedidos Hoje</h3>
                    <div class="value" data-target="42">{{$qtdPedidos}}</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon icon-revenue">
                    <i class="fa-solid fa-sack-dollar"></i>
                </div>
                <div class="stat-info">
                    <h3>Renda do Mês</h3>
                    <div class="value" data-target="{{ $total }}" data-prefix="R$ ">{{ $total }}</div>
                </div>
            </div>
        </div>

        <!-- Tables -->
        <div class="tables-grid">
            <!-- Últimos Produtos -->
            <div class="table-card">
                <div class="table-header">
                    <h2><i class="fa-solid fa-clock-rotate-left" style="margin-right: 8px; color: var(--primary);"></i>Últimos 5 Produtos</h2>
                    <a href="{{ Route('dashboard.produtos') }}" class="btn-view-all">Ver todos</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Categoria</th>
                            <th>Preço</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody">
                        @foreach($ultimosProdutos as $ultimoProduto)
                         <tr>
                            <td style="font-weight: 500;">{{$ultimoProduto->nome}}</td>
                              @if($ultimoProduto->categoria == 1)
                                  
                                    <td style="color: var(--text-muted);">COMIDAS</td>
                                @elseif($ultimoProduto->categoria == 2)
                                   
                                    <td style="color: var(--text-muted);">BEBIDAS</td>
                                @else
                                    
                                    <td style="color: var(--text-muted);">SOBREMESAS</td>
                                @endif
                                <td style="font-weight: 600;">R$: {{$ultimoProduto->preco}}</td>
                                <td style="color: var(--text-muted);">{{ $ultimoProduto->created_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Últimos Pedidos -->
            <div class="table-card">
                <div class="table-header">
                    <h2><i class="fa-solid fa-receipt" style="margin-right: 8px; color: var(--success);"></i>Últimos 5 Pedidos</h2>
                    <a href="#" class="btn-view-all">Ver todos</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Ficha</th>
                            <th>Valor</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="orders-table-body">
                        @foreach($ultimasCompras as $ultimaCompra)
                            <tr>
                                <td style="font-weight: 600; color: var(--primary);">{{ $ultimaCompra->id}}</td>
                                <td>#{{ $ultimaCompra->cliente }}</td>
                                <td style="font-weight: 600;">R$: {{$ultimaCompra->total}}</td>
                                @if($ultimaCompra->status == 1)
                                    <td><span class="status-badge status-pending">Pendente</span></td>
                                @elseif($ultimaCompra->status == 2)
                                    <td><span class="status-badge status-paid">Pago</span></td>
                                @else
                                    <td><span class="status-badge status-cancelled">Cancelado</span></td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</main>
@endsection