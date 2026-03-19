<?php
session_start();
include('../configs/conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['id_usuario'])) {
    $id_user = $_SESSION['id_usuario'];
    $id_filme = $_POST['id_filme'];
    $nota = $_POST['nota'];
    $comentario = mysqli_real_escape_string($conn, $_POST['comentario']);

    $sql = "INSERT INTO reviews (id_usuario, id_filme, nota, comentario) 
            VALUES ('$id_user', '$id_filme', '$nota', '$comentario')";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../index.php?sucesso=1");
    } else {
        echo "Erro ao postar: " . mysqli_error($conn);
    }
} else {
    header("Location: ../login.php");
}
?>