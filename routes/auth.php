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
    })->can('administrador', 'App\Models\User');
});