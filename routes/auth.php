<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models;

Route::middleware(['auth'])->group(function() {    
    Route::post('logout', [Controllers\LoginController::class, 'logout']);
    Route::post('redefinir_senha', [Controllers\RecuperacaoSenhaController::class,'redefinir_senha']);  
    
    Route::controller(Controllers\EmpresaController::class)->group(function(){
        Route::prefix('empresas')->group(function(){
            Route::get('/', 'index');
            Route::get('lista', 'lista');
            Route::post('adicionar', 'adicionar');
            Route::put('editar/{id}', 'editar');
            Route::get('detalhes/{id}', 'detalhes');
        });
    });

    Route::controller(Controllers\TipoEmpreendimentoController::class)->group(function(){
        Route::prefix('tipos_empreendimentos')->group(function(){
            Route::get('/', 'index');
            Route::get('lista', 'lista');
            Route::post('adicionar', 'adicionar');
            Route::put('editar/{id}', 'editar');
            Route::get('detalhes/{id}', 'detalhes');
            Route::get('pesquisar/{parametro}/{valor}', 'pesquisar');
        });
    });

    Route::controller(Controllers\TopicoController::class)->group(function(){
        Route::prefix('topicos')->group(function(){
            Route::get('/', 'index');
            Route::get('lista', 'lista');
            Route::post('adicionar', 'adicionar');
            Route::put('editar/{id}', 'editar');
            Route::get('detalhes/{id}', 'detalhes');
            Route::get('pesquisar/{parametro}/{valor}', 'pesquisar');
        });
    });

    Route::controller(Controllers\AreaController::class)->group(function(){
        Route::prefix('areas')->group(function(){
            Route::get('/', 'index');
            Route::get('lista', 'lista');
            Route::post('adicionar', 'adicionar');
            Route::put('editar/{id}', 'editar');
            Route::get('detalhes/{id}', 'detalhes');
            Route::get('pesquisar/{parametro}/{valor}', 'pesquisar');
        });
    });

    Route::controller(Controllers\TematicaController::class)->group(function(){
        Route::prefix('tematicas')->group(function(){
            Route::get('/', 'index');
            Route::get('lista', 'lista');
            Route::post('adicionar', 'adicionar');
            Route::put('editar/{id}', 'editar');
            Route::get('detalhes/{id}', 'detalhes');
            Route::get('pesquisar/{parametro}/{valor}', 'pesquisar');
        });
    });    

    Route::controller(Controllers\TagController::class)->group(function(){
        Route::prefix('tags')->group(function(){
            Route::get('/', 'index');
            Route::get('lista', 'lista');
            Route::post('adicionar', 'adicionar');
            Route::put('editar/{id}', 'editar');
            Route::get('detalhes/{id}', 'detalhes');
            Route::get('pesquisar/{parametro}/{valor}', 'pesquisar');
        });
    });

    Route::controller(Controllers\PerguntaController::class)->group(function(){
        Route::prefix('perguntas')->group(function(){
            Route::get('/', 'index');
            Route::get('lista', 'lista');
            Route::post('adicionar', 'adicionar');
            Route::put('editar/{id}', 'editar');
            Route::get('detalhes/{id}', 'detalhes');
        });
    });
});