<?php
session_start();

// 1. SEGURANÇA MÁXIMA: Verifica se é o Admin (Leão de Chácara)
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true || $_SESSION['is_admin'] != 1) {
    header("Location: ../login.php");
    exit();
}

// 2. Conexão com o banco (usamos ../ porque estamos dentro da pasta admin)
include '../configs/conexao.php';

// 3. Verifica se os dados realmente vieram do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Captura e limpa os espaços em branco das pontas
    $titulo = trim($_POST['titulo']);
    $sinopse = trim($_POST['sinopse']);
    $nota = trim($_POST['nota']);
    $caminho_capa = trim($_POST['caminho_capa']);

    // 4. Prepara a Query de Inserção
    $sql = "INSERT INTO filmes (titulo, sinopse, nota, caminho_capa) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // "ssds" significa: String (título), String (sinopse), Double/Decimal (nota), String (caminho_capa)
        $stmt->bind_param("ssds", $titulo, $sinopse, $nota, $caminho_capa);

        if ($stmt->execute()) {
            // Sucesso! Volta para o painel com um aviso na URL
            header("Location: index.php?sucesso=1");
            exit();
        } else {
            // Se o banco recusar a gravação
            echo "<h3 style='color: red; text-align: center; margin-top: 50px;'>Erro ao salvar o filme: " . $stmt->error . "</h3>";
        }
        $stmt->close();
    } else {
        // Se a Query estiver escrita errada
        echo "<h3 style='color: red; text-align: center; margin-top: 50px;'>Erro de conexão: " . $conn->error . "</h3>";
    }
}
$conn->close();
?>