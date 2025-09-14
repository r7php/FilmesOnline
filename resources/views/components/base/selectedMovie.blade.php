
<x-base.header />

  <style>
    body {
      background-color: #0b0d17;
      color: #fff;
      font-family: 'Segoe UI', Arial, sans-serif;
    }
    .elenco-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.elenco-foto {
    width: 15%;
    border-radius: 5px;
    object-fit: cover;
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
    .elenco-container {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;

}

.elenco-item {
    width: 15%;
}

.elenco-foto {
    width: 100%;
    border-radius: 5px;

}

.elenco-nome {
    font-size: 0.9rem;
    color: #ddd;

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

        @if(request()->has('movie'))
         <div class="col-12">
    <iframe
        src="https://vidsrc.xyz/embed/movie/{{ $data['imdb_id'] }}"
        title="Filme"
        width="100%"
        height="500"
        frameborder="0"
        allowfullscreen
        allow="autoplay; fullscreen; picture-in-picture; encrypted-media">
    </iframe>
  </div>
        @endif

    <!-- Poster -->
    <div class="col-md-5">
      <img src="https://www.themoviedb.org/t/p/w780/{{ $data['img'] }}"
           alt="Poster do Filme"
           class="movie-poster"
           style="max-height:900px;">
    </div>

    <!-- Detalhes -->
    <div class="col-md-7 details-section">
      <h2>Detalhes do Filme</h2>
      <div class="movie-info">
        <p><strong>Lançamento:</strong> {{ $data['release_date'] }}</p>
        <p><strong>Duração:</strong> {{ $data['runtime'] }} min</p>
        <p><strong>Avaliação:</strong> ⭐ {{ $data['vote_average'] }}/10</p>
        <p><strong>Tempo desde o lançamento:</strong> {{ $data['tempo_filme'] }}</p>
      </div>

      {{-- <form method="POST" class="mt-3">
        @csrf --}}
        <div class="d-flex flex-wrap gap-3">
        <a href="https://vidsrc.xyz/embed/movie/{{ $data['imdb_id'] }}" target="_blank">
  <button name="movie" class="btn btn-custom btn-watch">▶ Assistir</button></a>
          <button type="button" class="btn btn-custom btn-share">🔗 Compartilhar</button>
        </div>
      {{-- </form> --}}

      <div class="sinopse mt-4">
        <h4>Sinopse</h4>
        <p>{{ $data['overview'] }}</p>
        <hr>
        <h4>Elenco Principal</h4>

        <div class="elenco-container">
          @if(!empty($data['elenco']))
              @foreach(array_slice($data['elenco'], 0, 10) as $ator)
                  @if(!empty($ator['profile_path']))
                      <div class="elenco-item text-center">
                          <img src="https://image.tmdb.org/t/p/original{{ $ator['profile_path'] }}"
                               alt="Foto de {{ $ator['name'] ?? 'Ator' }}"
                               class="elenco-foto" />
                          <p class="elenco-nome mt-1">{{ $ator['name'] ?? 'Ator' }}</p>
                      </div>
                  @endif
              @endforeach
          @endif
        </div>

      </div>
    </div>
  </div>
</div>
