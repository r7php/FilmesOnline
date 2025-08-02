<?php 
    /**
     * 
     */
    class detalhesController extends controller{

 
        public function index(){    
            $dados = array('dados'=>'');
            $token2 =  $_ENV['TOKEN_BEARER'];
            $a = new api($token2);

            if(isset($_GET['id'])){

               $id = $_GET['id'];
               $data = $a->movieId($id);
        
               
               //echo json_encode($response);

               $dados['dados'] = $data;


            }

            $this->loadTemplate('detalhes', $dados);
        }

   
     }




?>