<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RespostaController extends Controller
{
    use AuthorizesRequests;

    public function detalhes_resposta($formulario_id, $pergunta_id){        
        $formulario = Models\Formulario::find($formulario_id);
        if(!$formulario){
            return response()->json('Formulário não encontrado!', 404);
        }
        $pergunta = Models\Pergunta::find($pergunta_id);
        if(!$pergunta){
            return response()->json('Pergunta não encontrada!', 404);
        }
        $resposta = Models\Resposta::where('formulario_id', $formulario_id)
        ->where('pergunta_id', $pergunta_id)
        ->first();
        return response()->json([
            'resposta' => $resposta,
            'pergunta' => $pergunta
        ], 200);
    }
    
}
