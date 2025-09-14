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
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>

document.addEventListener("DOMContentLoaded", function () {

    const baseUrl = "<?php echo env('BASE_URL'); ?>";
    const container = document.getElementById("cards-container");
    let input = document.getElementById("submitFilme");

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
                 let id = this.value;
                 console.log(id);
                 // window.location.href = `${baseUrl}/?page=${id}`;

                fetch(`${baseUrl}/api/buscarFilmeID/${id}`, {
                    method: 'GET',
                    headers:{
                         "Content-Type": "application/json",
                    },

                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    const dt2 = data.results;
                    document.getElementById("cards-container").innerHTML = "";

                    dt2.forEach(filme2 =>{
                        const title = filme2.original_title;
                        const release_date = filme2.release_date.substring(0, 4);
                        const path = filme2.poster_path;
                        const img = `https://www.themoviedb.org/t/p/w1280/${path}`;
                        const id = filme2.id;

                        const card = document.createElement("div");
                        card.classList.add("col-md-4");
                        card.innerHTML = `
                            <div class='image-container'>
                                <a href='selectedMovie/${id}'><img src='${img}'></a>
                            </div>
                            <h5 class="card-title">${title}</h5>
                            <p class='date'>${release_date}</p>
                            <a href='selectedMovie/${release_date}'>
                                <button class="btn btn-primary">Assistir agora</button>
                            </a>
                        `;
                        container.appendChild(card);

                        });
                        window.scrollTo({ top: 0, behavior: "smooth" });

                    });
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
                        <a href='selectedMovie/${id}'><img src='${img}'></a>
                    </div>
                    <h5 class="card-title">${title}</h5>
                    <p class='date'>${release_date}</p>
                    <a href='selectedMovie/${id}'>
                        <button class="btn btn-primary">Assistir agora</button>
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

