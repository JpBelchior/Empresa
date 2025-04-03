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
            Route::get('/', 'index')->can('administrador', App\Models\User::class);
            Route::get('lista', 'lista');
            Route::post('adicionar', 'adicionar')->can('administrador', App\Models\User::class);
            Route::put('editar/{id}', 'editar')->can('administrador', App\Models\User::class);
            Route::get('detalhes/{id}', 'detalhes')->can('administrador', App\Models\User::class);
            Route::post('trocar_empresa', 'trocar_empresa')->can('administrador', App\Models\User::class);
        });
    });

    Route::controller(Controllers\TipoEmpreendimentoController::class)->group(function(){
        Route::prefix('tipos_empreendimentos')->group(function(){
            Route::get('/', 'index')->can('administrador', App\Models\User::class);
            Route::get('lista', 'lista');
            Route::post('adicionar', 'adicionar')->can('administrador', App\Models\User::class);
            Route::put('editar/{id}', 'editar')->can('administrador', App\Models\User::class);
            Route::get('detalhes/{id}', 'detalhes')->can('administrador', App\Models\User::class);
            Route::get('pesquisar/{parametro}/{valor}', 'pesquisar');
        });
    });

    Route::controller(Controllers\TopicoController::class)->group(function(){
        Route::prefix('topicos')->group(function(){
            Route::get('/', 'index')->can('administrador', App\Models\User::class);
            Route::get('lista', 'lista');
            Route::post('adicionar', 'adicionar')->can('administrador', App\Models\User::class);
            Route::put('editar/{id}', 'editar')->can('administrador', App\Models\User::class);
            Route::get('detalhes/{id}', 'detalhes')->can('administrador', App\Models\User::class);
            Route::get('pesquisar/{parametro}/{valor}', 'pesquisar');
        });
    });

    Route::controller(Controllers\AreaController::class)->group(function(){
        Route::prefix('areas')->group(function(){
            Route::get('/', 'index')->can('administrador', App\Models\User::class);
            Route::get('lista', 'lista');
            Route::post('adicionar', 'adicionar')->can('administrador', App\Models\User::class);
            Route::put('editar/{id}', 'editar')->can('administrador', App\Models\User::class);
            Route::get('detalhes/{id}', 'detalhes')->can('administrador', App\Models\User::class);
            Route::get('pesquisar/{parametro}/{valor}', 'pesquisar');
        });
    });

    Route::controller(Controllers\TematicaController::class)->group(function(){
        Route::prefix('tematicas')->group(function(){
            Route::get('/', 'index')->can('administrador', App\Models\User::class);
            Route::get('lista', 'lista');
            Route::post('adicionar', 'adicionar')->can('administrador', App\Models\User::class);
            Route::put('editar/{id}', 'editar')->can('administrador', App\Models\User::class);
            Route::get('detalhes/{id}', 'detalhes')->can('administrador', App\Models\User::class);
            Route::get('pesquisar/{parametro}/{valor}', 'pesquisar');
        });
    });    

    Route::controller(Controllers\TagController::class)->group(function(){
        Route::prefix('tags')->group(function(){
            Route::get('/', 'index')->can('administrador', App\Models\User::class);
            Route::get('lista', 'lista');
            Route::post('adicionar', 'adicionar')->can('administrador', App\Models\User::class);
            Route::put('editar/{id}', 'editar')->can('administrador', App\Models\User::class);
            Route::get('detalhes/{id}', 'detalhes')->can('administrador', App\Models\User::class);
            Route::get('pesquisar/{parametro}/{valor}', 'pesquisar');
        });
    });

    Route::controller(Controllers\PerguntaController::class)->group(function(){
        Route::prefix('perguntas')->group(function(){
            Route::get('/', 'index')->can('administrador', App\Models\User::class);
            Route::get('lista', 'lista');
            Route::post('adicionar', 'adicionar')->can('administrador', App\Models\User::class);
            Route::post('editar/{id}', 'editar')->can('administrador', App\Models\User::class);
            Route::get('detalhes/{id}', 'detalhes')->can('administrador', App\Models\User::class);
        });
    });

    Route::controller(Controllers\ArquivoController::class)->group(function(){
        Route::prefix('arquivos')->group(function(){
            Route::get('/download/{arquivo}', 'download');
            Route::delete('/excluir/{arquivo}', 'excluir');
            Route::get('exibir/{imagem?}', 'exibir');
        });        
    });

    Route::controller(Controllers\UsuarioController::class)->group(function(){
        Route::prefix('usuarios')->group(function(){
            Route::get('/', 'index')->can('administrador', App\Models\User::class);
            Route::get('lista', 'lista');
            Route::post('adicionar', 'adicionar')->can('administrador', App\Models\User::class);
            Route::put('editar/{id}', 'editar')->can('administrador', App\Models\User::class);
            Route::get('detalhes/{id}', 'detalhes')->can('administrador', App\Models\User::class);
        });
    });

    Route::controller(Controllers\FuncionarioController::class)->group(function(){
        Route::prefix('funcionarios')->group(function(){
            Route::get('/', 'index');
            Route::get('lista', 'lista');
            Route::post('adicionar', 'adicionar');
            Route::put('editar/{id}', 'editar');
            Route::get('detalhes/{id}', 'detalhes');
            Route::get('pesquisar/{parametro}/{valor}', 'pesquisar');
        });
    });

    Route::controller(Controllers\ProjetoController::class)->group(function(){
        Route::prefix('projetos')->group(function(){
            Route::get('/', 'index');
            Route::get('lista', 'lista');
            Route::post('adicionar', 'adicionar');
            Route::put('editar/{id}', 'editar');
            Route::get('detalhes/{id}', 'detalhes');
        });
    });
});