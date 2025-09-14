
<x-base.header />


<style>
body {
    background-color: #0b0d17;
    color: #fff;
    font-family: 'Segoe UI', Arial, sans-serif;
    line-height: 1.6;
}

/* Container geral de filmes */
.movie-container {
    max-width: 1200px;
    margin: 50px auto;
    background-color: #1c1f2e;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.5);
    overflow: hidden;
    padding: 20px;
}

/* Poster do filme */
.movie-poster {
    width: 100%;
    height: auto;
    object-fit: cover;
    border-radius: 12px;
    transition: transform 0.3s;
}
.movie-poster:hover {
    transform: scale(1.05);
}

/* Seção de detalhes */
.details-section {
    padding: 20px;
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

/* Botões personalizados */
.btn-custom {
    padding: 10px 20px;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: bold;
    transition: all 0.3s ease;
    cursor: pointer;
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

/* Sinopse */
.sinopse {
    font-size: 1rem;
    margin-top: 20px;
    line-height: 1.5;
    color: #cfcfcf;
}

/* Iframe para trailer ou vídeo */
iframe {
    border: none;
    width: 100%;
    min-height: 600px;
    border-radius: 12px;
    margin-bottom: 30px;
}

/* Elenco */
.elenco-container {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    justify-content: start;
    margin-top: 20px;
}
.elenco-item {
    width: 12%;
    text-align: center;
    transition: transform 0.3s;
}
.elenco-item:hover {
    transform: scale(1.05);
}
.elenco-foto {
    width: 100%;
    border-radius: 8px;
    object-fit: cover;
}
.elenco-nome {
    font-size: 0.9rem;
    color: #ddd;
    margin-top: 5px;
}

/* Cards de filmes */
.card {
    background-color: #1c1f2e;
    border: none;
    border-radius: 12px;
    transition: transform 0.3s, box-shadow 0.3s;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.6);
}
.card-title {
    font-size: 1.1rem;
    font-weight: 600;
}
.card-text {
    font-size: 0.9rem;
    color: #ccc;
}

/* Loader */
.loader {
    display: none;
    width: 50px;
    height: 50px;
    border: 5px solid #0d6efd;
    border-top: 5px solid #fff;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin: auto;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Responsividade */
@media (max-width: 992px) {
    .elenco-item { width: 18%; }
}
@media (max-width: 768px) {
    .movie-poster { border-radius: 12px 12px 0 0; }
    iframe { min-height: 400px; }
    .elenco-item { width: 25%; }
}
@media (max-width: 576px) {
    .elenco-item { width: 33%; }
}
</style>

<div class="container mt-5">
    <div class="row g-4" id="cards-container">

        <div class="loader" style="display: none;"></div>

        @for($i = 1; $i < count($data); $i++)
            <div class="col-md-3">
                <div class="card h-100 shadow-sm">
                    @if($data[$i]['img'])
                        <img src="https://image.tmdb.org/t/p/w300{{ $data[$i]['img'] }}"
                             class="card-img-top"
                             alt="{{ $data[$i]['title'] }}">
                    @else
                        <img src="https://via.placeholder.com/300x450?text=Sem+Imagem"
                             class="card-img-top"
                             alt="Sem imagem">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $data[$i]['title'] }}</h5>
                        <p class="card-text">
                            <strong>Lançamento:</strong> {{ $data[$i]['release_date'] ?? '---' }}<br>
                            <strong>Nota:</strong> {{ $data[$i]['vote_average'] ?? '-' }}/10
                        </p>
                        <a href=""> <p class="card-text text-truncate" style="max-height: 60px; overflow: hidden;">
                        </p>
                    </a>
                        <a href="/selectedMovie/{{ $data[$i]['id'] }}" class="btn btn-primary btn-custom btn-watch w-100">
                            Assistir Agora
                        </a>
                    </div>
                </div>
            </div>
        @endfor

    </div>
</div>
