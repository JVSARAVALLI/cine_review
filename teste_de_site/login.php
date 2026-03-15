<?php
// Ativa a exibição de erros (modo detetive)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Puxa a conexão com o banco
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineReview - Login</title>
    <link rel="stylesheet" href="assets/style.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body class="login-page">

    <header class="login-header">
        <a href="index.html" class="logo">Cine<span class="highlight">Review</span></a>
    </header>

    <div class="login-wrapper">
        <div class="login-card">
            <h2>Entrar</h2>
            
            <form action="backend/autenticar.php" method="POST">
                
                <div class="input-group">
                    <input type="text" name="nome" placeholder="Insira seu usuário" required>
                </div>

                <div class="input-group">
                    <input type="email" name="email" placeholder="Email ou número de telefone" required>
                </div>
                <div class="input-group">
                    <input type="password" name="senha" placeholder="Senha" required>
                </div>
                <button type="submit" class="btn-primary btn-block">Entrar</button>
                <div class="form-help">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" checked>
                        <label for="remember">Lembre-se de mim</label>
                    </div>
                    <a href="#">Precisa de ajuda?</a>
                </div>
            </form>

            <div class="login-footer">
                <p>Novo por aqui? <a href="cadastro.html" class="signup-link">Assine agora</a>.</p>
                <p class="small-text">Esta página é protegida pelo Google reCAPTCHA para garantir que você não é um robô.</p>
            </div>
        </div>
    </div>

</body>
</html>