<?php
session_start();
include('../configs/conexao.php');

// Só deleta se for Admin
if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
    $id_review = $_GET['id'];
    
    $sql = "DELETE FROM reviews WHERE id_review = $id_review";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: ../admin/moderar.php?msg=deletado");
    } else {
        echo "Erro ao deletar.";
    }
} else {
    header("Location: ../index.php");
}
?>