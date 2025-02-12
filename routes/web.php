<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AtendenteController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\PainelController;
use App\Http\Controllers\PrioridadeController;
use App\Http\Controllers\SenhaController;
use App\Http\Controllers\Servico_Prioridade;
use App\Http\Controllers\Servico_PrioridadeController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\TouchController;
use App\Http\Controllers\TriagemController;
use App\Models\Departamento;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('/');
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
Route::get('/servico.delete/{servico}',[ServicoController::class,'destroy'])->name('servico.delete');

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
Route::get('/local.delete/{local}',[LocalController::class,'destroy'])->name('local.delete');

##---> ROTAS PARA ATENDENTE
Route::get('/atendente',[AtendenteController::class,'index'])->name('atendente');
Route::get('/atendente.create',[AtendenteController::class,'create'])->name('atendente.create');
Route::post('/atendente.store',[AtendenteController::class,'store'])->name('atendente.store');
Route::get('/atendente.edit/{atendente}',[AtendenteController::class,'edit'])->name('atendente.edit');
Route::put('/atendente.update/{atendente}',[AtendenteController::class,'update'])->name('atendente.update');
Route::get('/atendente.painel',[AtendenteController::class,'painel'])->name('atendente.painel');
Route::get('/atendente.atualizaFila',[AtendenteController::class,'atualizaFila'])->name('atendente.atualizaFila');
Route::get('/atendente.chamar',[AtendenteController::class,'chamarProximo'])->name('atendente.chamar');
Route::get('/atendente.inicia/{atendimento}',[AtendenteController::class,'iniciaAtendimento'])->name('atendente.inicia');
Route::get('/atendente.encerra/{atendimento}',[AtendenteController::class,'encerraAtendimento'])->name('atendente.encerra');
Route::get('/atendente.naoComapareceu/{atendente}',[AtendenteController::class,'naoComapareceu'])->name('atendente.naoComapareceu');
Route::get('/atendente.delete/{atendente}',[AtendenteController::class,'destroy'])->name('atendente.delete');


## ----->ROTAS PARA TRIAGEM
Route::get('/triagem',[TriagemController::class,'index'])->name('triagem');
Route::get('/triagem.config/{atendente}',[TriagemController::class,'config'])->name('triagem.config');
Route::put('/triagem.store/{atendente}',[TriagemController::class,'store'])->name('triagem.store');
Route::get('/triagem.show/{atendente}',[TriagemController::class,'show'])->name('triagem.show');
Route::get('/triagem/{id_servico}/{id_atendente}', [TriagemController::class, 'destroy'])->name('triagem.destroy');
Route::get('/triagem.destivaServico/{id_servico}/{id_atendente}', [TriagemController::class, 'destivaServico'])->name('triagem.destivaServico');


## ---->    ROTAS PRA PAINELTOUCH 
Route::get('/touch',[TouchController::class,'index'])->name('touch');
Route::get('/touch.create',[TouchController::class,'create'])->name('touch.create');
Route::put('/touch.store',[TouchController::class,'store'])->name('touch.store');
Route::get('/touch.config/{touch}',[TouchController::class,'config'])->name('touch.config');
Route::put('/touch.save',[TouchController::class,'save'])->name('touch.save');
Route::get('/touch.destivaServico/{id_touch}/{id}',[TouchController::class,'destivaServico'])->name('touch.destivaServico');




#######----->ROTAS  PARA SENHAS

Route::get('/senha', [SenhaController::class, 'index'])->name('senha');
//Route::get('/senha.triagem/{id_departamento}/{departamento}', [SenhaController::class, 'triagem'])->name('senha.triagem');
Route::get('/senha.emitir/{id_servico}/{prioridade}', [SenhaController::class, 'emitir'])->name('senha.emitir');






});

##############->ROTAS PARA PAINEIS <----#############
Route::get('/painel.show/{painel}',[PainelController::class,'show'])->name('painel.show');
Route::get('/painel',[PainelController::class,'index'])->name('painel');
Route::get('/painel.create',[PainelController::class,'create'])->name('painel.create');
Route::post('/painel.store',[PainelController::class,'store'])->name('painel.store');
Route::get('/painel.config/{painel}',[PainelController::class,'config'])->name('painel.config');
Route::put('/painel.save',[PainelController::class,'save'])->name('painel.save');
Route::get('/painel.painelAtualiza/{painel}',[PainelController::class,'painelAtualiza'])->name('painel.painelAtuliza');
Route::get('/painel.destivaServico/{painel_servico}/{id}',[PainelController::class,'destivaServico'])->name('painel.destivaServico');
Route::get('/painel.desativarPainel/{painel}',[PainelController::class,'desativarPainel'])->name('painel.desativarPainel');


require __DIR__.'/auth.php';
