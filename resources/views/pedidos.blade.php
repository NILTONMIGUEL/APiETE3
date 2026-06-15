@extends('layouts.app_layouts')
@section('conteudo')
       <!-- Main Content -->
    <main class="main-content">
        <header class="page-header">
            <div>
                <h1>Gerenciar Pedidos</h1>
                <p style="color: var(--text-muted); font-size: 0.9rem; margin-top: 4px;">Acompanhe e gerencie todas as vendas da sua loja.</p>
            </div>
        </header>
         <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon" style="background: var(--primary-light); color: var(--primary);"><i class="fa-solid fa-bag-shopping"></i></div>
                <div class="stat-info"><h3>Total de Pedidos</h3><div class="value" id="stat-total">{{ $qtdPedidos }}</div></div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: var(--warning-light); color: var(--warning);"><i class="fa-solid fa-clock"></i></div>
                <div class="stat-info"><h3>Pendentes</h3><div class="value" id="stat-pending">{{ $pendentes }}</div></div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: var(--success-light); color: var(--success);"><i class="fa-solid fa-check-circle"></i></div>
                <div class="stat-info"><h3>Concluídos</h3><div class="value" id="stat-completed">{{ $concluidos }}</div></div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: #f3e8ff; color: #9333ea;"><i class="fa-solid fa-sack-dollar"></i></div>
                <div class="stat-info"><h3>Receita Total</h3><div class="value" id="stat-revenue">{{ $valorFormatado }}</div></div>
            </div>
        </div>
        <!-- Table -->
        <div class="table-card">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fichas</th>
                            <th>Data</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th style="text-align: center;">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="orders-table-body">
                        @foreach ($pedidos as $pedido )
                            <tr>
                                <td><span class="order-id">{{ $pedido->id }}</span></td>
                                <td>
                                    <div class="customer-info">
                                        <span class="customer-name"># {{$pedido->cliente}}</span>
                                    </div>
                                </td>
                                <td>{{$pedido->created_at->format('d/m/Y') }}</td>
                                <td style="font-weight: 700;">R$: {{ $pedido->total }}</td>
                                @if($pedido->status == 1)
                                    <td><span class="status-badge status-pending">Pendente</span></td>
                                @elseif($pedido->status == 2)
                                    <td><span class="status-badge status-completed">Pago</span></td>
                                @else
                                    <td><span class="status-badge status-cancelled">Cancelado</span></td>
                                @endif
                                <td>
                                    <div class="action-btns" style="justify-content: center;">
                                        <form action="{{ route('dashboard.cancelar', $pedido->id) }}" method="POST">
                                            @csrf
                                            <button class="btn-action btn-view" title="Cancelar">
                                                <i class="fa-solid fa-circle-xmark"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('dashboard.atualizar', $pedido->id) }}" method="post">
                                            @csrf
                                            <button class="btn-action btn-status" title="Pago" type="submit">
                                                <i class="fa-solid fa-rotate"></i>
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
@endsection