<?php 
$img = $dados['poster_path'] ?? '';
$overview = $dados['overview'] ?? 'Sinopse não disponível.';
$tempo_filme = $tempo_filme ?? 0; 
$release_date = $dados['release_date'] ?? 'Data desconhecida';
$runtime = $dados['runtime'] ?? '---';
$imdb_id = $dados['imdb_id'] ?? '';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detalhes do Filme</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #0b0d17;
      color: #fff;
      font-family: 'Segoe UI', Arial, sans-serif;
    }
    .movie-container {
      max-width: 1100px;
      margin: 50px auto;
      background-color: #1c1f2e;
      border-radius: 12px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.5);
      overflow: hidden;
    }
    .movie-poster {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 12px 0 0 12px;
    }
    .details-section {
      padding: 30px;
    }
    .details-section h2 {
      font-size: 2rem;
      margin-bottom: 20px;
      color: #f8f9fa;
    }
    .movie-info p {
      margin-bottom: 8px;
      font-size: 1rem;
      color: #d1d1d1;
    }
    .btn-custom {
      padding: 10px 20px;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: bold;
      transition: 0.3s;
    }
    .btn-watch {
      background-color: #0d6efd;
      border: none;
      color: #fff;
    }
    .btn-watch:hover {
      background-color: #0b5ed7;
    }
    .btn-share {
      background-color: #dc3545;
      border: none;
      color: #fff;
    }
    .btn-share:hover {
      background-color: #bb2d3b;
    }
    .sinopse {
      font-size: 1rem;
      margin-top: 20px;
      line-height: 1.5;
      color: #cfcfcf;
    }
    iframe {
      border: none;
      width: 100%;
      min-height: 600px;
      border-radius: 12px;
      margin-bottom: 30px;
    }
    @media (max-width: 768px) {
      .movie-poster {
        border-radius: 12px 12px 0 0;
      }
      iframe {
        min-height: 400px;
      }
    }
  </style>
</head>
<body>

<div class="container">
  <div class="movie-container row g-0">
    
    <?php if(isset($_POST['movie'])): ?>
      <div class="col-12">
        <iframe src="https://vidsrc.xyz/embed/movie/<?php echo htmlspecialchars($imdb_id); ?>" 
                title="Filme">
        </iframe>
      </div>
    <?php endif; ?>

    <!-- Poster -->
    <div class="col-md-5">
      <img src="https://www.themoviedb.org/t/p/w780/<?php echo ltrim($img, '/'); ?>" 
           alt="Poster do Filme" 
           class="movie-poster">
    </div>

    <!-- Detalhes -->
    <div class="col-md-7 details-section">
      <h2>Detalhes do Filme</h2>
      <div class="movie-info">
        <p><strong>Lançamento:</strong> <?php echo htmlspecialchars($release_date); ?></p>
        <p><strong>Duração:</strong> <?php echo htmlspecialchars($runtime); ?> min</p>
        <p><strong>Avaliação:</strong> ⭐ 7.5 / 10</p>
        <p><strong>Tempo desde o lançamento:</strong> <?php echo htmlspecialchars($tempo_filme); ?> anos</p>
      </div>

      <form method="POST" class="mt-3">
        <div class="d-flex flex-wrap gap-3">
          <button name="movie" class="btn btn-custom btn-watch">▶ Assistir</button>
          <button type="button" class="btn btn-custom btn-share">🔗 Compartilhar</button>
        </div>
      </form>

      <div class="sinopse mt-4">
        <h4>Sinopse</h4>
        <p><?php echo nl2br(htmlspecialchars($overview)); ?></p>
      </div>
    </div>
  </div>
</div>

</body>
</html>
