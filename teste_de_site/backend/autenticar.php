<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../configs/conexao.php';

// --- FUNÇÃO DE DESIGN DE ERRO ---
function mostrarErro($titulo, $mensagem, $textoBotao, $link) {
    echo '<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>CineReview - Aviso</title>
        <link rel="stylesheet" href="../assets/style.css">
        <style>
            .error-box { text-align: center; padding: 40px; }
            .error-box h2 { color: var(--accent-red); margin-bottom: 15px; font-size: 1.8rem; }
            .error-box p { color: var(--text-gray); margin-bottom: 30px; line-height: 1.5; }
            .btn-error { text-decoration: none; justify-content: center; width: 100%; }
        </style>
    </head>
    <body class="login-page">
        <div class="login-wrapper">
            <div class="login-card error-box">
                <h2>' . $titulo . '</h2>
                <p>' . $mensagem . '</p>
                <a href="' . $link . '" class="btn-primary btn-error">' . $textoBotao . '</a>
            </div>
        </div>
    </body>
    </html>';
}
// ---------------------------------

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = trim($_POST['email']);
    $senha_digitada = trim($_POST['senha']);

    // BUSCA ATUALIZADA: Agora pegamos o ID e o nível de Admin
    $sql = "SELECT id_usuario, nome_usuario, senha_usuario, is_admin FROM login WHERE email_usuario = ?";

    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            
            $usuario = $resultado->fetch_assoc();
            
            if (password_verify($senha_digitada, $usuario['senha_usuario'])) {
                // --- SESSÃO ATUALIZADA ---
                $_SESSION['logado'] = true;
                $_SESSION['id_usuario'] = $usuario['id_usuario']; // NOVO: Guardamos o ID para as reviews
                $_SESSION['email_usuario'] = $email;
                $_SESSION['nome_usuario'] = $usuario['nome_usuario'];
                $_SESSION['is_admin'] = $usuario['is_admin']; // 0 ou 1
                
                // --- REDIRECIONAMENTO INTELIGENTE ---
                if ($_SESSION['is_admin'] == 1) {
                    header("Location: ../admin/index.php"); // Vai para o painel se for Admin
                } else {
                    header("Location: ../index.php"); // Vai para a home se for usuário comum
                }
                exit();
                
            } else {
                mostrarErro("Senha Incorreta", "A senha que você digitou não confere com os nossos registros.", "Tentar Novamente", "../login.php");
            }
            
        } else {
            mostrarErro("Email Não Encontrado", "Não encontramos nenhuma conta associada a este e-mail.", "Criar Nova Conta", "../cadastro.html");
        }
        
        $stmt->close();
    } else {
        mostrarErro("Erro Técnico", "Tivemos um problema de conexão com o servidor.", "Voltar", "../login.php");
    }
}
?>