<?php 
    /**
     * 
     */

    ini_set('log_errors', 1);
    ini_set('error_log', '/path/to/php-error.log');
    error_reporting(E_ALL);


    class apiController extends controller{
    
    public function buscar_filme_nome(){
      
        header("Content-Type: application/json");
        $json  = file_get_contents("php://input");
        $dados = json_decode($json, true);
        $token1 =  $_ENV['TOKEN_GET'];
        $api = new Api($token1);
        
        $nomeFilme = $dados['nomeFilme'];
          
        $response = $api->buscarPorNomeFilme($nomeFilme);
        
        echo json_encode($response);
        exit;

    }


    public function buscarFilmeID(){
        header("Content-Type: application/json");
        $json  = file_get_contents("php://input");
        $dados = json_decode($json, true);
        $token1 =  $_ENV['TOKEN_GET'];
        $id = $dados['id'];
        $api = new Api($token1);
        $response = $api->FilmeID($id);
        
        echo json_encode($response);
        exit;

    }

    public function buscar_filme(){

        $token1 =  $_ENV['TOKEN_GET'];
        
        $api = new Api($token1);
        
        $response = $api->buscar_tudo();
        
        echo json_encode($response);
        exit;
    }



      
     

     
     }




?>