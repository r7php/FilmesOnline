

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Filmes</title>

    <!-- <link rel="shortcut icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTey3oSmYFAzRaib7cmOE-3It7bN_NInyqkJg&s" > -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  </head>

<body data-base-url="<?php echo BASE_URL; ?>">

<style>
  body{
    background: black;
  }

  .fixed-image {
  position: fixed;
  top: 50%; 
  right: 10px; 
  transform: translateY(-50%); 
  max-height: 400px; 
  object-fit: cover;
  z-index: 10; 
}
  .date{
    color: red ;
  }
  .card-title{
    color: white;
    font-weight: 700;
  }
   .image-container {
      overflow: hidden; 
      width: 300px;
      height: 400px; 
      border-radius: 10px; 
      transition: all 0.3s ease-in-out; 
    }

    .image-container img {
      width: 100%; 
      height: 100%;
      object-fit: cover; 
      transition: transform 0.3s ease-in-out;
    }

  
    .image-container:hover img {
      transform: scale(1.2); 
    }
    .space{
      height: 100px;
    }
</style>
 <nav class="navbar navbar-expand-lg ">
    <div class="container">
     <a href="<?php echo BASE_URL; ?>"><img src="<?php echo BASE_URL; ?>/assets/img/imgPoster.png"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto" >

          <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>" style="color: red;">Início</a></li>
          <li class="nav-item"><a class="nav-link" href="#" style="color: red;">Filmes</a></li>
          <li class="nav-item"><a class="nav-link" href="#" style="color: red;"><input type="text" id="filmeinput" class="form-control"></a></li>
          <li class="nav-item"><a class="nav-link" href="#" style="color: red;"><input type="button" id="submitFilme" placeholder="Ex:Superman" value="Pesquisar" class="btn btn-danger"></a></li>
        </ul>
      </div>
    </div>
  </nav>
  


<?php 
	
	$this->loadViewTemplate($viewName, $viewData);	

?>
</body>



 

</body>
</html>