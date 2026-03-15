<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../configs/conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST['nome'])&& isset($_POST['email']) && isset($_POST['senha'])) {
        
        $nome = trim($_POST['nome']);
        $email = trim($_POST['email']);
        // Criptografando a senha antes de salvar! (Prática essencial de segurança)
        $senha = password_hash(trim($_POST['senha']), PASSWORD_DEFAULT);

        $sql = "INSERT INTO login (nome_usuario, email_usuario, senha_usuario) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            $stmt->bind_param("sss", $nome, $email, $senha);
            
            // Aqui entra a mágica do Try/Catch para capturar o erro do banco
            try {
                $stmt->execute();
                // Se deu certo, redireciona para o login
                header("Location: ../login.php");
                exit(); 
                
            } catch (mysqli_sql_exception $e) {
                // O código 1062 é o padrão do MySQL para "Entrada Duplicada"
                if ($e->getCode() == 1062) {
                    echo "<div style='background: #1a1a1a; color: white; padding: 50px; text-align: center; font-family: sans-serif;'>";
                    echo "<h2 style='color: #e50914;'>Ops! Esse e-mail já está cadastrado.</h2>";
                    echo "<p>Parece que você já tem uma conta conosco.</p>";
                    echo "<br><a href='../login.php' style='color: white; padding: 10px 20px; background: #e50914; text-decoration: none; border-radius: 4px;'>Ir para o Login</a>";
                    echo "</div>";
                } else {
                    // Se for outro erro bizarro, ele mostra aqui
                    echo "Erro técnico ao salvar: " . $e->getMessage();
                }
            }
            
            $stmt->close();
        } else {
            echo "<h2>Erro na estrutura da Query!</h2>";
        }
    }
}
?>