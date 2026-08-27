<?php 
    /**
     * 
     */
    class homeController extends controller{

 
        public function index(){  
    
            $dados = array();
            $token1 =  $_ENV['TOKEN_GET'];
            $a = new api($token1);
            
            // $token2 =  getenv('TOKEN_BEARER');

            $this->loadTemplate('home', $dados);
        }

    
     }




?>