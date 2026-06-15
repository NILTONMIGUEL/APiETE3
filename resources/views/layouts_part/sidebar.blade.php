<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="logo">
        <i class="fa-solid fa-chart-line"></i>
        <span>NexusAdmin</span>
    </div>
    <ul class="menu">
        <a href="{{ Route('dashboard.retornarQtdComidas') }}" class="menu-item {{ Route::is('dashboard.retornarQtdComidas') ? 'active' : '' }}">
            <i class="fa-solid fa-house"></i> Dashboard
        </a>
        <a href="{{ Route('dashboard.produtos') }}" class="menu-item {{ Route::is('dashboard.produtos') ? 'active' : '' }} {{ Route::is('dashboard.cadastrar') ? 'active' : ''}}">
            <i class="fa-solid fa-box-open"></i> Produtos
        </a>
        <a href="{{ Route('dashboard.pedidos') }}" class="menu-item {{ Route::is('dashboard.pedidos') ? 'active' : '' }} ">
            <i class="fa-solid fa-cart-shopping"></i> Pedidos
        </a>
        <a href="#" class="menu-item">
            <i class="fa-solid fa-circle-xmark"></i> Sair
        </a>
    </ul>
</aside>