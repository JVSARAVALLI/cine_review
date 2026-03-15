<?php
session_start();

// O LEÃO DE CHÁCARA: Só passa quem for Admin (1)
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true || $_SESSION['is_admin'] != 1) {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel ADM - CineReview</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        .admin-container { max-width: 800px; margin: 50px auto; padding: 30px; background: var(--card-bg); border-radius: 10px; border: 1px solid #333; }
        .admin-form input, .admin-form textarea { width: 100%; padding: 12px; margin-top: 5px; margin-bottom: 20px; background: #222; border: 1px solid #444; color: white; border-radius: 5px; }
        .admin-form label { color: var(--text-gray); font-weight: bold; }
        .header-admin { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 1px solid #333; padding-bottom: 20px; }
    </style>
</head>
<body style="background-color: #141414; color: white; font-family: sans-serif;">
    
    <div class="admin-container">
        <div class="header-admin">
            <h1 style="color: var(--accent-red);">Centro de Comando</h1>
            <a href="../index.php" class="btn-login" style="background: #333; border: 1px solid #555;">Voltar ao Site</a>
        </div>

        <h2>Cadastrar Novo Filme</h2>
        <p style="color: var(--text-gray); margin-bottom: 20px;">Preencha os dados abaixo para adicionar um filme ao catálogo principal.</p>

        <form action="salvar_filme.php" method="POST" class="admin-form">
            
            <label>Título do Filme</label>
            <input type="text" name="titulo" placeholder="Ex: The Batman" required>

            <label>Sinopse</label>
            <textarea name="sinopse" rows="4" placeholder="Um breve resumo do filme..." required></textarea>

            <label>Nota (0.0 a 10.0)</label>
            <input type="number" step="0.1" name="nota" placeholder="Ex: 8.5" required>

            <label>Caminho da Capa</label>
            <input type="text" name="caminho_capa" placeholder="Ex: assets/capas/nome da capa" required>

            <button type="submit" class="btn-primary" style="width: 100%; padding: 15px; font-size: 1.1rem;">Publicar Filme</button>
        </form>
    </div>

</body>
</html>