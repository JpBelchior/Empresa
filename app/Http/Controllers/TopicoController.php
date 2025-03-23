<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TopicoController extends Controller
{
    use AuthorizesRequests;
    
    public function index(){                
        return view('topicos.index');
    }

    public function lista(){
        return Models\Topico::orderBy('nome', 'asc')->get();
    }

    public function adicionar(Request $request){
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:255',            
        ]);
        if($validator->fails()){            
            return response()->json($validator->errors(), 422);
        }        
        Models\Auditoria::registrar_atividade('Cadastro de Tópico');
        Models\Topico::adicionar($request);
        return response()->json('Tópico cadastrado com sucesso!', 200);
    }

    public function editar($topico_id, Request $request){        
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:255',            
        ]);
        if($validator->fails()){            
            return response()->json($validator->errors(), 422);
        }        
        Models\Auditoria::registrar_atividade('Edição de Tópico');
        Models\Topico::editar($topico_id, $request);
        return response()->json('Tópico editado com sucesso!', 200);
    }

    public function pesquisar($parametro, $valor){
        if($parametro == 'ativo'){
            $ativo = $valor == 'true' ? true : false;
            return Models\Topico::where('ativo', $ativo)->orderBy('nome', 'asc')->get();    
        }
        return Models\Topico::where($parametro, "like", "%$valor%")->orderBy('nome', 'asc')->get();
    }

    public function detalhes($topico_id){
        return Models\Topico::find($topico_id);
    }
}
