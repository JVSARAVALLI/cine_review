<?php
// 1. Liga o sistema de pulseiras (Sessões)
session_start();

// 2. Verifica se a pessoa TEM a pulseira de logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    // Se não tiver, chuta ela de volta pra tela de login imediatamente!
    header("Location: login.php");
    exit(); 
}

include 'configs/conexao.php';

// 1. Busca os filmes no banco
$sql_filmes = "SELECT * FROM filmes ORDER BY id_filme DESC";
$resultado_filmes = $conn->query($sql_filmes);

// 2. Cria uma "Caixa" vazia
$lista_filmes = []; 

// 3. Se achou filmes, guarda todos dentro da caixa com segurança!
if ($resultado_filmes && $resultado_filmes->num_rows > 0) {
    while($linha = $resultado_filmes->fetch_assoc()) {
        $lista_filmes[] = $linha; 
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineReview - Base</title>
    <link rel="stylesheet" href="assets/style.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>

    <nav class="navbar">
        <div class="logo">Cine<span class="highlight">Review</span></div>
        <div class="search-bar">
            <input type="text" placeholder="Buscar filmes, animes...">
            <button><i class="ph ph-magnifying-glass"></i></button>
        </div>
        <ul class="menu">
            <li><a href="#">Filmes</a></li>
            <li><a href="#">Séries</a></li>
            
            <?php if(isset($_SESSION['logado']) && $_SESSION['logado'] === true): ?>
                <li style="display: flex; align-items: center; gap: 15px;">
                    <span style="color: var(--text-gray); font-size: 0.9rem;">
                        Olá, <strong style="color: white;"><?php echo $_SESSION['nome_usuario']; ?></strong>
                    </span>
                    
                    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                        <a href="admin/index.php" style="color: #E50914; font-weight: bold; text-decoration: none; font-size: 0.9rem;">
                            <i class="ph ph-gear"></i> Painel ADM
                        </a>
                    <?php endif; ?>

                    <a href="logout.php" class="btn-login" style="background-color: #333; border: 1px solid #555;" onclick="return confirm('Tem certeza que deseja sair do CineReview?');">Sair</a>
                </li>
            <?php else: ?>
                <li><a href="login.php" class="btn-login">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <header class="hero" style="background-image: url('https://placehold.co/1920x800/1a1a1a/555?text=Banner+do+Filme');">
        <div class="hero-overlay">
            <div class="hero-content">
                <span class="tag">Destaque da Semana</span>
                <h1>placeholder</h1> 
                
                <div class="meta-info">
                    <span>placehold</span> • <span>placeholder</span> • <span>placehold</span>
                </div>

                <p class="description">
                    placeholder
                </p>

                <div class="actions">
                    <button class="btn-primary"><i class="ph ph-play"></i> Ver Trailer</button>
                    <button class="btn-secondary"><i class="ph ph-plus"></i> Minha Lista</button>
                </div>
            </div>
        </div>
    </header>

    <main class="container">
        <h2 class="section-title">Últimas Análises</h2>
        
        <div class="movie-grid">
            <?php 
            // Conta se tem algum filme dentro da nossa caixa
            if (count($lista_filmes) > 0): 
                // PARA CADA filme na caixa, desenhe o card abaixo:
                foreach($lista_filmes as $filme): 
            ?>
            <article class="movie-card">
                <div class="poster-wrapper">
                    <img src="<?php echo $filme['caminho_capa']; ?>" alt="Poster do filme">
                    <div class="rating-badge">
                        <i class="ph ph-star-fill"></i> <?php echo $filme['nota']; ?>
                    </div>
                </div>
                <div class="card-info">
                    <h3><?php echo $filme['titulo']; ?></h3>
                    <span class="genre"><?php echo substr($filme['sinopse'], 0, 30); ?>...</span>
                </div>
            </article>
            <?php 
                endforeach; // Fim do loop
            else: 
            ?>
                <p style="color: white; padding: 20px;">Nenhum filme cadastrado no momento.</p>
            <?php endif; ?>
        </div>

        </div>
    </main>

    <footer>
        <p>Desenvolvido para Estudos • Integração com Banco de Dados em breve.</p>
    </footer>

</body>
</html>