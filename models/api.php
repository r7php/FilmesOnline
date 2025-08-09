<?php 

/**
 * 
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


class api extends model
{   
    public $token1;
   

    public function __construct($token1) {
        $this->token1 = $token1;
        
    }
    private function remover_acentos($string) {
    $comAcentos = ['á','à','ã','â','ä','é','è','ê','ë','í','ì','î','ï','ó','ò','õ','ô','ö','ú','ù','û','ü','ç','Á','À','Ã','Â','Ä','É','È','Ê','Ë','Í','Ì','Î','Ï','Ó','Ò','Õ','Ô','Ö','Ú','Ù','Û','Ü','Ç','´','`','^','~','¨'];
    $semAcentos = ['a','a','a','a','a','e','e','e','e','i','i','i','i','o','o','o','o','o','u','u','u','u','c','A','A','A','A','A','E','E','E','E','I','I','I','I','O','O','O','O','O','U','U','U','U','C','','','','',''];

    return str_replace($comAcentos, $semAcentos, $string);
}

    public function buscarPorNomeFilme($nomeFilme){
       $token = $this->token1;
       $fimeNameCorrigido = $this->remover_acentos($nomeFilme);
       $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.themoviedb.org/3/search/movie?api_key=$token&query=".urlencode($fimeNameCorrigido)."&language=pt-BR",
            CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        if (curl_errno($curl)) {
            echo 'Erro cURL: ' . curl_error($curl);
            exit;
        }

        curl_close($curl);

        // Decodifica para array associativo
        $resJson = json_decode($response, true);

        // Verifica se retornou JSON válido
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo "Erro ao decodificar JSON: " . json_last_error_msg();
            exit;
        }

        // Retorna o resultado (em array)
        return $resJson;
    }
    public function elencoFilme($id){
        
       $token = $this->token1;
       $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.themoviedb.org/3/movie/$id/credits?&language=pt-BR",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $token"
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);


        if (curl_errno($curl)) {
            echo 'Erro cURL: ' . curl_error($curl);
            exit;
        }

        curl_close($curl);

        // Decodifica para array associativo
        $resJson = json_decode($response, true);

        // Verifica se retornou JSON válido
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo "Erro ao decodificar JSON: " . json_last_error_msg();
            exit;
        }

        // Retorna o resultado (em array)
        return $resJson;

    }

    public function movieId($id){
        $token = $this->token1;
       $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.themoviedb.org/3/movie/$id?&language=pt-BR",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $token"
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);


        if (curl_errno($curl)) {
            echo 'Erro cURL: ' . curl_error($curl);
            exit;
        }

        curl_close($curl);

        // Decodifica para array associativo
        $resJson = json_decode($response, true);

        // Verifica se retornou JSON válido
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo "Erro ao decodificar JSON: " . json_last_error_msg();
            exit;
        }

        // Retorna o resultado (em array)
        return $resJson;

    }

    public function FilmeID($count){
    

        // header("Content-Type: application/json");
        // $dadosRecebidos = file_get_contents("php://input");
        // $dados = json_decode($dadosRecebidos, true);

        // echo json_decode($dados['page']);


            // echo $id;
       $token = $this->token1;
       $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.themoviedb.org/3/movie/popular?api_key=$token&language=pt-BR&page=$count",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
      
        curl_close($curl);

        $data = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->logBd("Erro ao decodificar a resposta JSON");
            echo json_encode([
                "error" => "Erro ao processar dados da API",
                "message" => "Erro ao decodificar JSON: " . json_last_error_msg()
            ]);
            exit;
        }

        return $data;
  
    }


    public function buscar_tudo(){
       $token = $this->token1;
       $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.themoviedb.org/3/movie/popular?api_key=$token&language=pt-BR",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
      
        curl_close($curl);

        $data = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->logBd("Erro ao decodificar a resposta JSON");
            echo json_encode([
                "error" => "Erro ao processar dados da API",
                "message" => "Erro ao decodificar JSON: " . json_last_error_msg()
            ]);
            exit;
        }

        return $data;

    }
    






}







?>