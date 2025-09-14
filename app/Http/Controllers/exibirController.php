<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class exibirController extends Controller
{
    public function remover_acentos($string) {
        $comAcentos = ['á','à','ã','â','ä','é','è','ê','ë','í','ì','î','ï','ó','ò','õ','ô','ö','ú','ù','û','ü','ç','Á','À','Ã','Â','Ä','É','È','Ê','Ë','Í','Ì','Î','Ï','Ó','Ò','Õ','Ô','Ö','Ú','Ù','Û','Ü','Ç','´','`','^','~','¨'];
        $semAcentos = ['a','a','a','a','a','e','e','e','e','i','i','i','i','o','o','o','o','o','u','u','u','u','c','A','A','A','A','A','E','E','E','E','I','I','I','I','O','O','O','O','O','U','U','U','U','C','','','','',''];

        return str_replace($comAcentos, $semAcentos, $string);
    }

    public function buscarFilmeID($num){
       $token = env('TOKEN_URL');
       $count = $num;
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
            exit;
        }

        return $data;
}
public function buscarPorNomeFilme(Request $request)
{
    // dd($request->all());
    $token = env('TOKEN_URL');
    $dados = $request->all();
    $nomeFilme = $dados['filme'];
    $filmeNameCorrigido = $this->remover_acentos($nomeFilme);

    $url = "https://api.themoviedb.org/3/search/movie?api_key=$token&query=".urlencode($filmeNameCorrigido)."&language=pt-BR";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    $response = curl_exec($ch);

    // verifique erros ANTES de fechar o handle
    if (curl_errno($ch)) {
        $err = curl_error($ch);
        curl_close($ch);
        return response()->json(['error' => 'cURL error', 'message' => $err], 500);
    }

    curl_close($ch);

    $resJson = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        // devolve parte do raw para debugar (não deixe isso em produção)
        return response()->json([
            'error' => 'JSON decode error',
            'message' => json_last_error_msg(),
            'raw_start' => substr($response, 0, 1000)
        ], 500);
    }
    //dd($resJson);
    $dadosFilme[] = [];
    for($i=1;$i<=10;$i++){
        if(isset($resJson['results'][$i])){
            $movie = $resJson['results'][$i];
            $dadosFilme[] = [
                'id' => $movie['id'],
                'img' => $movie['poster_path'],
                'title' => $movie['title'],
                'overview' => $movie['overview'],
                'release_date' => $movie['release_date'],
                'vote_average' => $movie['vote_average']
            ];


        }
    }
     return view('components.base.filmePesquisado', ['data' => $dadosFilme]);

}


    public function buscarPorNomeFilme2(Request $r){
    $token = env('TOKEN_URL');
    $nomeFilme = $r->input('nome_filme');
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

    public function selectedMovie($id){
        if(!empty($id)){
            $data = $this->movieId($id);
            $elenco = $this->elencoFilme($id);
            $cast = $elenco['cast'];

            $hoje = date_create(date('Y-m-d'));
            $filme_date = date_create($data['release_date']);
            $diff = date_diff($filme_date, $hoje);
            $tempo_filme = $diff->format("%y anos");

            $dadosFilme = [
                'img'          => $data['poster_path'],
                'title'        => $data['title'],
                'overview'     => $data['overview'],
                'release_date' => $data['release_date'],
                'tempo_filme'  => $tempo_filme,
                'runtime'      => $data['runtime'],
                'imdb_id'      => $data['imdb_id'],
                'vote_average' => $data['vote_average'],
                'elenco'       => $cast
            ];

           // dd($dadosFilme);

            return view('components.base.selectedMovie', ['data' => $dadosFilme, 'elenco' => $cast]);

        }

        //return view('components.base.selectedMovie', ['dados' => $dados]);
    }

    public function movieId($id){
        $token = env('TOKEN_BEAER');
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

    public function elencoFilme($id){
        $token = env('TOKEN_BEAER');
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
    public function buscar_filme_nome(Request $request){
       $token = env('TOKEN_URL');
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
            exit;
        }

        return response()->json(json_decode($response, true));
       // return response()->json(json_decode($response, true));
    }
}
