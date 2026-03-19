<?php
session_start();
include('../configs/conexao.php');

// Segurança: Só entra se for Admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../index.php");
    exit();
}

$all_reviews = mysqli_query($conn, "
    SELECT r.*, l.nome_usuario, f.nome_filme 
    FROM reviews r 
    JOIN login l ON r.id_usuario = l.id_usuario 
    JOIN filmes f ON r.id_filme = f.id_filme
");
?>

<h2>Painel de Moderação de Comentários</h2>
<table border="1">
    <tr>
        <th>Usuário</th>
        <th>Filme</th>
        <th>Comentário</th>
        <th>Ações</th>
    </tr>
    <?php while($rev = mysqli_fetch_assoc($all_reviews)): ?>
    <tr>
        <td><?php echo $rev['nome_usuario']; ?></td>
        <td><?php echo $rev['nome_filme']; ?></td>
        <td><?php echo $rev['comentario']; ?></td>
        <td>
            <a href="../backend/excluir_review.php?id=<?php echo $rev['id_review']; ?>" 
               onclick="return confirm('Deletar este comentário?')">Excluir</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>