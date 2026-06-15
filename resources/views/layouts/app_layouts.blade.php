<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrativo</title>
    <!-- Fontes Google -->
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @if(Route::is('dashboard.retornarQtdComidas'))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @elseif(Route::is('dashboard.produtos'))
        @vite(['resources/css/produtoscss.css', 'resources/js/app.js'])
    @elseif(Route::is('dashboard.pedidos'))
        @vite(['resources/css/pedidoscss.css', 'resources/js/app.js'])
    @elseif(Route::is('dashboard.cadastrar'))
        @vite(['resources/css/cadastrarProdutos.css', 'resources/js/app.js'])
    @elseif(Route::is('dashboard.editar'))
        @vite(['resources/css/cadastrarProdutos.css', 'resources/js/app.js'])
    @endif

</head>
<body>

   
    @include('layouts_part.sidebar')
    
    @yield('conteudo')


</body>
</html>