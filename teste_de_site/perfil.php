<?php
session_start();
include('configs/conexao.php');

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['id_usuario'];
$user_query = mysqli_query($conn, "SELECT * FROM login WHERE id_usuario = $id");
$user = mysqli_fetch_assoc($user_query);

// Busca as reviews do usuário e o nome do filme relacionado
$reviews_query = mysqli_query($conn, "
    SELECT r.*, f.nome_filme 
    FROM reviews r 
    JOIN filmes f ON r.id_filme = f.id_filme 
    WHERE r.id_usuario = $id 
    ORDER BY r.data_postagem DESC
");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="assets/style.css">
    <title>Meu Perfil - CineReview</title>
</head>
<body>
    <h1>Olá, <?php echo $user['nome_usuario']; ?>!</h1>
    <p>Email: <?php echo $user['email_usuario']; ?></p>
    <a href="index.php">Voltar para Início</a>

    <h2>Minhas Avaliações</h2>
    <?php while($row = mysqli_fetch_assoc($reviews_query)): ?>
        <div class="review-card">
            <h3><?php echo $row['nome_filme']; ?></h3>
            <p>Nota: <?php echo $row['nota']; ?>/5</p>
            <p>"<?php echo $row['comentario']; ?>"</p>
            <small>Postado em: <?php echo date('d/m/Y', strtotime($row['data_postagem'])); ?></small>
        </div>
    <?php endwhile; ?>
</body>
</html>