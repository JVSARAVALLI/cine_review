<?php
// 1. Liga o motor de sessões para encontrar a sessão atual do usuário
session_start();

// 2. Limpa todas as variáveis da sessão (tira o nome, email, status de logado)
session_unset();

// 3. Destrói a sessão completamente do servidor
session_destroy();

// 4. Redireciona o usuário de volta para a tela de login
header("Location: login.php");

// 5. Garante que o script pare de rodar imediatamente após o redirecionamento
exit();
?>