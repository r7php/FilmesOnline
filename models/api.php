<?php 

/**
 * 
 */



class api extends model
{   
    public $token1;
   

    public function __construct($token1) {
        $this->token1 = $token1;
        
    }
 
    public function paginacaoFilms(){
    $TOKEN_GET = $this->token1;
    //$token =  $this->token1;
    $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.themoviedb.org/3/movie/popular?api_key=ba8c2a9fbdb79394a343cf2418f43375&language=pt-BR",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
       // var_dump($response);
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
        $dataTotal = [
            'total_pages'=>$data['total_pages']
        ];

        return $dataTotal;

    }
    public function movieId($id){
        $token = $this->token1;
       $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.themoviedb.org/3/movie/$id?null=null&language=pt-BR",
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