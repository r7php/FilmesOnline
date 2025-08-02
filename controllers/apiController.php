<?php 
    /**
     * 
     */

    ini_set('log_errors', 1);
    ini_set('error_log', '/path/to/php-error.log');
    error_reporting(E_ALL);


    class apiController extends controller{
    
    public function buscar_filme(){

        $token1 =  $_ENV['TOKEN_GET'];
        
        $api = new Api($token1);
        
        $response = $api->buscar_tudo();
        
        echo json_encode($response);
        exit;
    }



      
     

     
     }




?>