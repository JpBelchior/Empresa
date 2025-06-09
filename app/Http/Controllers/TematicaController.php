<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TematicaController extends Controller
{
    use AuthorizesRequests;

    public function __construct(){
        session(["primeira_sessao" => "Temática"]);
    }
    
    public function index(){             
        session(["segunda_sessao" => "Visão Geral"]);
        return view('tematicas.index');
    }

    public function lista(){
        return Models\Tematica::orderBy('nome', 'asc')->get();
    }

    public function adicionar(Request $request){
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:255',            
        ]);
        if($validator->fails()){            
            return response()->json($validator->errors(), 422);
        }        
        Models\Auditoria::registrar_atividade('Cadastro de Temática');
        Models\Tematica::adicionar($request);
        return response()->json('Temática cadastrado com sucesso!', 200);
    }

    public function editar($tematica_id, Request $request){        
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:255',            
        ]);
        if($validator->fails()){            
            return response()->json($validator->errors(), 422);
        }        
        Models\Auditoria::registrar_atividade('Edição de Temática');
        Models\Tematica::editar($tematica_id, $request);
        return response()->json('Temática editado com sucesso!', 200);
    }

    public function pesquisar($parametro, $valor){
        if($parametro == 'ativo'){
            $ativo = $valor == 'true' ? true : false;
            return Models\Tematica::where('ativo', $ativo)->orderBy('nome', 'asc')->get();
        }
        return Models\Tematica::where($parametro, "like", "%$valor%")->orderBy('nome', 'asc')->get();
    }

    public function detalhes($topico_id){
        return Models\Tematica::find($topico_id);
    }
}
