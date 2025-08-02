<style>

#pageInt {
  display: flex;
  flex-wrap: wrap; /* permite quebrar linha se tiver muitos botões */
  gap: 8px;        /* espaço entre os botões */
  justify-content: center; /* centraliza */
  margin-top: 20px;
}

.button {
  width: 40px;
  height: 40px;
  text-align: center;
  line-height: 40px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
  outline: none;
  background: #fff;
  transition: all 0.2s ease-in-out;
  cursor: pointer;
}

.button:hover {
  background: #f0f0f0;
}

.button:focus {
  border-color: #007bff;
  box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

</style>

   <div class="container mt-5">
        <div class="row g-4" id="cards-container">

            <div class="loader" style="display: NONE;"></div>

            <!-- Os cards serão gerados dinamicamente aqui -->
      
        </div>


 <div class="row" id="pageInt" style="margin-top: 10px;">

</div>
</div>

<script>




document.addEventListener("DOMContentLoaded", function () {
    // Pega o atributo data-base-url do body
    const baseUrl = document.body.dataset.baseUrl;

    // let pageList = document.getElementById("pageList").val;


    fetch(`${baseUrl}/api/buscar_filme`, {
        method: 'GET'
    })
    .then(response => response.json())
    .then(data => {
    
        const dt = data.results;
        const container = document.getElementById("cards-container");
        const container2 = document.getElementById("pageInt");
        let inputID = document.getElementById("pageID");
       // console.log(dt);

        for(var i=1;i<=100;i++){
           
            const input = document.createElement("input");
            input.type = "button";
            input.id = "pageID"; 
            input.className = "button";
            input.name = "list";
            input.value = i;
            container2.appendChild(input)
            
            input.addEventListener("click", function () {
                 console.log("Botão clicado:", this.value);
            });

        }
    
        dt.forEach(filme => {

        
            const title = filme.original_title;
            const release_date = filme.release_date.substring(0, 4);
            const path = filme.poster_path;
            const img = `https://www.themoviedb.org/t/p/w1280/${path}`;
            const id = filme.id;

            const card = document.createElement("div");
            card.classList.add("col-md-4");
            card.innerHTML = `
                <div class='image-container'>
                    <a href='detalhes/?id=${id}'><img src='${img}'></a>
                </div>
                <h5 class="card-title">${title}</h5>
                <p class='date'>${release_date}</p>
                <a href='detalhes/?id=${release_date}'>
                    <button class="btn btn-primary">Detalhes</button>
                </a>
            `;
            container.appendChild(card);
        });

    })
    .catch(error => {
        console.error("Error:", error);
    })
    .finally(() => {
        // Esconde o loading
       // document.getElementById("loadingIcon").style.display = "none";
    });
});
</script>

<div class="space"></div>

<footer class="bg-dark text-white text-center py-3">
    <p>© 2025 Catálogo de Filmes. Todos os direitos reservados.</p>
</footer>

