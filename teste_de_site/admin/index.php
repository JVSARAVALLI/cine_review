<?php
session_start();
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Painel Administrativo - CineReview</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1>Painel de Controle</h1>
    <p>Bem-vindo, Administrador <?php echo $_SESSION['nome_usuario']; ?></p>
    
    <nav>
        <ul>
            <li><a href="cadastro_filme.php">Cadastrar Novo Filme</a></li>
            
            <li><a href="moderar.php">Gerenciar Avaliações (Reviews)</a></li>
            
            <li><a href="../index.php">Sair do Painel</a></li>
        </ul>
    </nav>
</body>
</html>