<?php 
    /**
     * 
     */
    class detalhesController extends controller{

 
        public function index(){    
            $dados = array('
                dados'=>''
            );

            $token2 =  $_ENV['TOKEN_BEARER'];
            $a = new api($token2);

            if(isset($_GET['id'])){

               $id = $_GET['id'];
               $data = $a->movieId($id);
               $elenco = $a->elencoFilme($id);
            
                $cast = $elenco['cast'];
       

               //var_dump($elenco['cast']);
               //echo json_encode($response);

               $dados['dados'] = ["data"=>$data, "elenco"=>$cast];


            }

            $this->loadTemplate('detalhes', $dados);
        }

   
     }




?>