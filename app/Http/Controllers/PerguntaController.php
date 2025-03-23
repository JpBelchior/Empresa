<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PerguntaController extends Controller
{
    use AuthorizesRequests;
    
    public function index(){                
        return view('perguntas.index');
    }

    public function lista(){        
        return Models\Pergunta::with(['tematica'])->orderBy('titulo', 'asc')->get();
    }

    public function adicionar(Request $request){
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|max:1000',
            'tematica_id' => 'required',
            'tipos_empreendimentos' => 'required|array',
            'topicos' => 'required|array',
            'areas' => 'required|array',
            'tags' => 'required|array'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        Models\Auditoria::registrar_atividade('Cadastro de Pergunta');
        Models\Pergunta::adicionar($request);
        return response()->json('Pergunta cadastrada com sucesso!', 200);
    }

    public function editar($tag_id, Request $request){        
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|max:1000',            
            'tematica_id' => 'required',
            'tipos_empreendimentos' => 'required|array',
            'topicos' => 'required|array',
            'areas' => 'required|array',
            'tags' => 'required|array'            
        ]);
        if($validator->fails()){            
            return response()->json($validator->errors(), 422);
        }        
        Models\Auditoria::registrar_atividade('Edição de Pergunta');
        Models\Pergunta::editar($tag_id, $request);
        return response()->json('Pergunta editada com sucesso!', 200);
    }

    public function detalhes($tag_id){
        return Models\Pergunta::with([
            'tematica',
            'tipos_empreendimentos.tipo_empreendimento',
            'topicos.topico',
            'areas.area',
            'tags.tag'
        ])->find($tag_id);
    }
}
