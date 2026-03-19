<?php
// 1. Liga o sistema de sessões
session_start();

// 2. Verifica se a pessoa está logada
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: login.php");
    exit(); 
}

include 'configs/conexao.php';

// 1. Busca os filmes no banco
$sql_filmes = "SELECT * FROM filmes ORDER BY id_filme DESC";
$resultado_filmes = $conn->query($sql_filmes);

$lista_filmes = []; 

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
    <title>CineReview - Home</title>
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
            <li><a href="index.php">Filmes</a></li>
            <li><a href="#">Séries</a></li>
            
            <?php if(isset($_SESSION['logado']) && $_SESSION['logado'] === true): ?>
                <li style="display: flex; align-items: center; gap: 15px;">
                    
                    <a href="perfil.php" style="text-decoration: none; display: flex; align-items: center; gap: 8px; color: white;">
                        <i class="ph ph-user-circle" style="font-size: 1.5rem; color: var(--accent-red);"></i>
                        <span style="font-size: 0.9rem;">Olá, <strong><?php echo $_SESSION['nome_usuario']; ?></strong></span>
                    </a>
                    
                    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                        <a href="admin/index.php" style="color: #E50914; font-weight: bold; text-decoration: none; font-size: 0.8rem; border: 1px solid #E50914; padding: 4px 8px; border-radius: 4px;">
                            ADM
                        </a>
                    <?php endif; ?>

                    <a href="logout.php" class="btn-login" style="background-color: #333; border: 1px solid #555; padding: 5px 10px;" onclick="return confirm('Sair do CineReview?');">Sair</a>
                </li>
            <?php else: ?>
                <li><a href="login.php" class="btn-login">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <header class="hero" style="background-image: url('https://images.alphacoders.com/133/1338309.png');">
        <div class="hero-overlay">
            <div class="hero-content">
                <span class="tag">Destaque da Semana</span>
                <h1>placeholder</h1> 
                
                <div class="meta-info">
                    <span>0000</span> • <span>00000</span> • <span>0000</span>
                </div>

                <p class="description">
                    0000
                </p>

                <div class="actions">
                    <button class="btn-primary"><i class="ph ph-play"></i> Ver Trailer</button>
                    <button class="btn-secondary"><i class="ph ph-plus"></i> Minha Lista</button>
                </div>
            </div>
        </div>
    </header>

    <main class="container">
        <h2 class="section-title">Catálogo de Filmes</h2>
        
        <div class="movie-grid">
            <?php if (count($lista_filmes) > 0): 
                foreach($lista_filmes as $filme): ?>
                
                <a href="detalhes_filme.php?id=<?php echo $filme['id_filme']; ?>" style="text-decoration: none; color: inherit;">
                    <article class="movie-card">
                        <div class="poster-wrapper">
                            <img src="assets/capas/<?php echo $filme['caminho_capa']; ?>" alt="Poster">
                            <div class="rating-badge">
                                <i class="ph ph-star-fill"></i> <?php echo number_format($filme['nota'], 1); ?>
                            </div>
                        </div>
                        <div class="card-info">
                            <h3><?php echo $filme['titulo']; ?></h3>
                            <span class="genre"><?php echo substr($filme['sinopse'], 0, 40); ?>...</span>
                        </div>
                    </article>
                </a>

            <?php endforeach; 
            else: ?>
                <p style="color: white; padding: 20px;">Nenhum filme cadastrado.</p>
            <?php endif; ?>
        </div>
    </main>

    <footer style="text-align: center; padding: 40px; color: var(--text-gray); border-top: 1px solid #333; margin-top: 50px;">
        <p>© 2026 CineReview • Sistema de Avaliações Ativado</p>
    </footer>

</body>
</html>