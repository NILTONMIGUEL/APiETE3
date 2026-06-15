<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Login | NexusAdmin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --primary-light: #e0e7ff;
            --bg-body: #f8fafc;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --success: #10b981;
            --danger: #ef4444;
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        html { font-size: 16px; -webkit-text-size-adjust: 100%; }

        body { 
            background-color: var(--bg-body); 
            color: var(--text-main); 
            height: 100vh;
            overflow: hidden;
        }

        /* --- Layout Principal --- */
        .login-container {
            display: flex;
            height: 100vh;
            width: 100vw;
        }

        /* --- Lado Esquerdo (Visual/Branding) --- */
        .login-visual {
            flex: 1;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        /* Efeito de fundo sutil */
        .login-visual::before {
            content: '';
            position: absolute;
            width: 150%;
            height: 150%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            top: -25%;
            left: -25%;
        }

        .visual-content {
            position: relative;
            z-index: 1;
            max-width: 400px;
            animation: slideUp 0.8s ease-out forwards;
        }

        .visual-logo {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .visual-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .visual-text {
            font-size: 1.1rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        /* --- Lado Direito (Formulário) --- */
        .login-form-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            background-color: white;
            animation: fadeIn 0.6s ease-out forwards;
        }

        .login-form {
            width: 100%;
            max-width: 420px;
        }

        .mobile-logo {
            display: none;
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 2rem;
            align-items: center;
            gap: 10px;
            justify-content: center;
        }
        .mobile-logo span { color: var(--text-main); }

        .form-header {
            margin-bottom: 2rem;
            text-align: center;
        }

        .form-header h1 {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--text-main);
        }

        .form-header p {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        /* --- Campos do Formulário --- */
        .form-group {
            margin-bottom: 1.25rem;
            position: relative;
        }

        .form-group label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 0.5rem;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 1rem;
            transition: color 0.3s;
        }

        .form-control {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 2.75rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: 0.95rem;
            color: var(--text-main);
            background-color: #f8fafc;
            outline: none;
            transition: all 0.3s ease;
            min-height: 50px;
        }

        .form-control:focus {
            border-color: var(--primary);
            background-color: white;
            box-shadow: 0 0 0 4px var(--primary-light);
        }

        .form-control:focus + .input-icon,
        .input-wrapper:focus-within .input-icon {
            color: var(--primary);
        }

        /* Botão de mostrar senha */
        .toggle-password {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            padding: 0.25rem;
            font-size: 1rem;
            transition: color 0.2s;
        }
        .toggle-password:hover { color: var(--text-main); }

        /* --- Opções (Lembrar / Esqueci senha) --- */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            color: var(--text-muted);
        }

        .remember-me input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: var(--primary);
            cursor: pointer;
        }

        .forgot-password {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }
        .forgot-password:hover { color: var(--primary-dark); text-decoration: underline; }

        /* --- Botão de Submit --- */
        .btn-submit {
            width: 100%;
            padding: 0.875rem;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 50px;
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2);
        }

        .btn-submit:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
        }

        .btn-submit:active { transform: translateY(0); }
        .btn-submit:disabled {
            background-color: #94a3b8;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        /* --- Footer --- */
        .form-footer {
            margin-top: 2rem;
            text-align: center;
            font-size: 0.9rem;
            color: var(--text-muted);
        }
        .form-footer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }
        .form-footer a:hover { text-decoration: underline; }

        /* --- Toast Notification --- */
        .toast {
            position: fixed; bottom: 2rem; right: 2rem; 
            padding: 1rem 1.5rem; border-radius: 10px; 
            box-shadow: var(--shadow-lg);
            transform: translateY(100px); opacity: 0; 
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            z-index: 2000; display: flex; align-items: center; gap: 10px; 
            font-weight: 500; color: white;
            max-width: calc(100% - 4rem);
        }
        .toast.show { transform: translateY(0); opacity: 1; }
        .toast.success { background: var(--success); }
        .toast.error { background: var(--danger); }

        /* --- Animations --- */
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }

        /* ==================== RESPONSIVIDADE ==================== */
        @media (max-width: 900px) {
            .login-visual { display: none; }
            .login-form-wrapper { padding: 1.5rem; }
            .mobile-logo { display: flex; }
        }

        @media (max-width: 480px) {
            html { font-size: 15px; }
            .login-form-wrapper { padding: 1rem; justify-content: flex-start; padding-top: 3rem; }
            .form-header h1 { font-size: 1.5rem; }
            .form-options { flex-direction: column; align-items: flex-start; gap: 0.75rem; }
        }
    </style>
</head>
<body>

    <div class="login-container">
        <!-- Lado Esquerdo: Branding (Desktop) -->
        <div class="login-visual">
            <div class="visual-content">
                <div class="visual-logo">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>NexusAdmin</span>
                </div>
                <h2 class="visual-title">Gerencie seu negócio com inteligência</h2>
                <p class="visual-text">Acesse o painel completo para controlar produtos, pedidos e acompanhar o crescimento da sua empresa em tempo real.</p>
            </div>
        </div>

        <!-- Lado Direito: Formulário -->
        <div class="login-form-wrapper">
            <form class="login-form" id="loginForm" onsubmit="handleLogin(event)">
                
                <!-- Logo Mobile -->
                <div class="mobile-logo">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>NexusAdmin</span>
                </div>

                <div class="form-header">
                    <h1>Bem-vindo de volta!</h1>
                    <p>Insira suas credenciais para acessar o painel.</p>
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <div class="input-wrapper">
                        <i class="fa-regular fa-envelope input-icon"></i>
                        <input type="email" id="email" name="email"  class="form-control" placeholder="seu@email.com" required autocomplete="email">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Senha</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password" id="password" class="form-control" name="password" placeholder="••••••••" required autocomplete="current-password">
                        <button type="button" class="toggle-password" onclick="togglePassword()" aria-label="Mostrar senha">
                            <i class="fa-regular fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" id="remember">
                        <span>Lembrar de mim</span>
                    </label>
                    <a href="#" class="forgot-password" onclick="showToast('Link de recuperação enviado para seu e-mail!', 'success')">Esqueceu a senha?</a>
                </div>

                <button type="submit" class="btn-submit" id="submitBtn">
                    <span>Entrar no Sistema</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </button>

                <div class="form-footer">
                    Não tem uma conta? <a href="#">Solicite acesso ao administrador</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast" id="toast">
        <i class="fa-solid fa-circle-check"></i>
        <span id="toastMessage">Mensagem aqui</span>
    </div>

  
</body>
</html>