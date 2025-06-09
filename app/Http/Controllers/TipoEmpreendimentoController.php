<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TipoEmpreendimentoController extends Controller
{
    use AuthorizesRequests;

    public function __construct(){
        session(["primeira_sessao" => "Tipos de Empreendimentos"]);
    }
    
    public function index(){                
        session(["segunda_sessao" => "Visão Geral"]);
        return view('tipos_empreendimentos.index');
    }

    public function lista(){
        return Models\TipoEmpreendimento::orderBy('nome', 'asc')->get();
    }

    public function adicionar(Request $request){
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:255',            
        ]);
        if($validator->fails()){            
            return response()->json($validator->errors(), 422);
        }        
        Models\Auditoria::registrar_atividade('Cadastro de Tipo de empreendimento');
        Models\TipoEmpreendimento::adicionar($request);
        return response()->json('Tipo de empreendimento cadastrado com sucesso!', 200);
    }

    public function editar($tipo_empreendimento_id, Request $request){        
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:255',            
        ]);
        if($validator->fails()){            
            return response()->json($validator->errors(), 422);
        }        
        Models\Auditoria::registrar_atividade('Edição de Tipo de empreendimento');
        Models\TipoEmpreendimento::editar($tipo_empreendimento_id, $request);
        return response()->json('Tipo de empreendimento editado com sucesso!', 200);
    }

    public function detalhes($tipo_empreendimento_id){
        return Models\TipoEmpreendimento::find($tipo_empreendimento_id);
    }

    public function pesquisar($parametro, $valor){
        if($parametro == 'ativo'){
            $ativo = $valor == 'true' ? true : false;
            return Models\TipoEmpreendimento::where('ativo', $ativo)->orderBy('nome', 'asc')->get();    
        }
        return Models\TipoEmpreendimento::where($parametro, "like", "%$valor%")->orderBy('nome', 'asc')->get();
    }
}
