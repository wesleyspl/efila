<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AtendenteController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\PrioridadeController;
use App\Http\Controllers\SenhaController;
use App\Http\Controllers\Servico_Prioridade;
use App\Http\Controllers\Servico_PrioridadeController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\TriagemController;
use App\Models\Departamento;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


## -----> ROTAS PRA DEPARTAMENTOS
Route::get('/departamento',[DepartamentoController::class,'index'])->name('departamento');
Route::get('/departamento.create',[DepartamentoController::class,'create'])->name('departamento.create');
Route::get('/departamento.edit/{departamento}',[DepartamentoController::class,'edit'])->name('departamento.edit');
Route::post('/departamento.store',[DepartamentoController::class,'store']);
Route::put('/departamento.update/{departamento}',[DepartamentoController::class,'update'])->name('departamento.update');

## ----> ROTAS PARA SERVICOS
Route::get('/servico',[ServicoController::class,'index'])->name('servicos');
Route::get('/servico.create',[ServicoController::class,'create'])->name('servicos.create');
Route::post('/servico.store',[ServicoController::class,'store'])->name('servicos.store');
Route::get('/servico.edit/{servico}',[ServicoController::class,'edit'])->name('servicos.edit');
Route::put('/servico.update/{servico}',[ServicoController::class,'update'])->name('servicos.update');

## -----> ROTAS PARA PRIORIDADES
Route::get('/prioridade.create',[PrioridadeController::class,'create'])->name('prioridade.create');
Route::get('/prioridade.edit/{prioridade}',[PrioridadeController::class,'edit'])->name('prioridade.edit');
Route::put('/prioridade.update/{prioridade}',[PrioridadeController::class,'update'])->name('prioridade.update');
Route::get('/prioridade/',[PrioridadeController::class,'index'])->name('prioridade');
Route::post('/prioridade.store',[PrioridadeController::class,'store'])->name('prioridade.store');

##-----> ROTAS PARA SERVICOS E PRIORIDADES
Route::put('/servico.prioridade.update/{prioridade}',[Servico_PrioridadeController::class,'update'])->name('servico.prioridade.update');
Route::get('/servico.prioridade/{servico}',[Servico_PrioridadeController::class,'index'])->name('servico.prioridade');
Route::get('/servico.prioridade.show/{servico}',[Servico_PrioridadeController::class,'show'])->name('servico.prioridade.show');
Route::post('/servico.prioridade.store',[Servico_PrioridadeController::class,'store'])->name('servico.prioridade.store');
Route::put('/servico.prioridade.destroy/{prioridade}',[Servico_PrioridadeController::class,'destroy'])->name('servico.prioridade.destroy');

## ---> ROTAS PARA LOCAIS
Route::get('/local',[LocalController::class,'index'])->name('local');
Route::get('/local.edit/{local}',[LocalController::class,'edit'])->name('local.edit');
Route::put('/local.update/{local}',[LocalController::class,'update'])->name('local.update');
Route::get('/local.create',[LocalController::class,'create'])->name('local.create');
Route::post('/local.store',[LocalController::class,'store'])->name('local.store');


##---> ROTAS PARA ATENDENTE
Route::get('/atendente',[AtendenteController::class,'index'])->name('atendente');
Route::get('/atendente.create',[AtendenteController::class,'create'])->name('atendente.create');
Route::post('/atendente.store',[AtendenteController::class,'store'])->name('atendente.store');
Route::get('/atendente.edit/{atendente}',[AtendenteController::class,'edit'])->name('atendente.edit');
Route::put('/atendente.update/{atendente}',[AtendenteController::class,'update'])->name('atendente.update');
Route::get('/atendente.painel',[AtendenteController::class,'painel'])->name('atendente.painel');
Route::get('/atendente.atualizaFila',[AtendenteController::class,'atualizaFila'])->name('atendente.atualizaFila');
Route::get('/atendente.chamar',[AtendenteController::class,'chamarProximo'])->name('atendente.chamar');


## ----->ROTAS PARA TRIAGEM
Route::get('/triagem',[TriagemController::class,'index'])->name('triagem');
Route::get('/triagem.config/{atendente}',[TriagemController::class,'config'])->name('triagem.config');
Route::put('/triagem.store/{atendente}',[TriagemController::class,'store'])->name('triagem.store');
Route::get('/triagem.show/{atendente}',[TriagemController::class,'show'])->name('triagem.show');
Route::get('/triagem/{id_servico}/{id_departamento}/{id_atendente}', [TriagemController::class, 'destroy'])->name('triagem.destroy');


#######----->ROTAS  PARA SENHAS

Route::get('/senha', [SenhaController::class, 'index'])->name('senha');
Route::get('/senha.triagem/{id_departamento}/{departamento}', [SenhaController::class, 'triagem'])->name('senha.triagem');
Route::get('/senha.emitir/{id_servico}/{id_departemanto}/{prioridade}', [SenhaController::class, 'emitir'])->name('senha.emitir');
});
require __DIR__.'/auth.php';
