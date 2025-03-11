<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function() {    
    Route::post('logout', [Controllers\LoginController::class, 'logout']);
    Route::post('redefinir_senha', [Controllers\RecuperacaoSenhaController::class,'redefinir_senha']);    
});