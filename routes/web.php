<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\exibirController;
Route::get('/', function () {
     return view('template');
})->name('home');

// Route::get('/home', function () {
//     return view('template');
// })->name('home');

Route::match(['get', 'post'], '/selectedMovie/{id}',[exibirController::class,'selectedMovie'])->name('filme.show');
Route::get("/api/buscar_filme_nome/",[exibirController::class,'buscarPorNomeFilme'])->name('buscarPorNomeFilme');
//Route::get('/selectedMovie/{id}',[exibirController::class,'selectedMovie'])->name('selectedMovie');

Route::match(['get','post'],'/api/buscarFilmeID/{num}',[exibirController::class,'buscarFilmeID'])->name('buscarFilmeID');
Route::get('/api/buscar_filme',[exibirController::class,'buscar_filme_nome'])->name('buscar_filme_nome');
