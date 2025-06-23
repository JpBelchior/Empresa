<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ClienteController extends Controller
{
    use AuthorizesRequests;

    public function __construct(){
        session(["nome_primeira_sessao" => "Clientes"]);
    }
    
    public function index(){                
        session(["segunda_sessao" => "Visão Geral"]);
        return view('clientes.index');
    }

    public function lista(){
        return Models\Cliente::where('empresa_id', session('empresa_id'))->orderBy('nome', 'asc')->get();
    }

    public function adicionar(Request $request){        
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:255',            
        ]);
        if($validator->fails()){            
            return response()->json($validator->errors(), 422);
        }        
        Models\Auditoria::registrar_atividade('Cadastro de Cliente');
        Models\Cliente::adicionar($request);
        return response()->json('Cliente cadastrada com sucesso!', 200);
    }

    public function editar($area_id, Request $request){        
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:255',            
        ]);
        if($validator->fails()){            
            return response()->json($validator->errors(), 422);
        }        
        Models\Auditoria::registrar_atividade('Edição de Cliente');
        Models\Cliente::editar($area_id, $request);
        return response()->json('Cliente editado com sucesso!', 200);
    }    

    public function detalhes($cliente_id){
        return Models\Cliente::find($cliente_id);
    }

    public function pesquisar($parametro, $valor){
        if($parametro == 'ativo'){
            $ativo = $valor == 'true' ? true : false;
            return Models\Cliente::where('empresa_id', session('empresa_id'))->where('ativo', $ativo)->orderBy('nome', 'asc')->get();
        }
        return Models\Cliente::where('empresa_id', session('empresa_id'))->where($parametro, "like", "%$valor%")->orderBy('nome', 'asc')->get();
    }
}
