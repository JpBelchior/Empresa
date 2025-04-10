<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FormularioController extends Controller
{
    use AuthorizesRequests;    
    
    public function index(){                        
        return view('formularios.index');
    }

    public function lista(){
        return Models\Formulario::with([
            'tipo_empreendimento',
            'criador',
            'projeto'
        ])
        ->where('empresa_id', session('empresa_id'))
        ->orderBy('nome', 'asc')->get();
    }

    public function interagir($formulario_id){
        $formulario = Models\Formulario::find($formulario_id);
        if(!$formulario){
            abort('404');
        }
        $perguntas = DB::table('perguntas')
        ->join('pergunta_tipo_empreendimento', 'perguntas.id' , '=', 'pergunta_tipo_empreendimento.pergunta_id')        
        ->where('pergunta_tipo_empreendimento.tipo_empreendimento_id', $formulario->tipo_empreendimento_id)
        ->get();
        $dados = [
            'formulario' => $formulario,
            'perguntas' => $perguntas
        ];
        return view('formularios.interagir', $dados);
    }

    public function registrar(Request $request){
        $validator = Validator::make($request->all(), [
            'resposta' => 'required|max:10000',
            'pergunta_id' => 'required',
            'formulario_id' => 'required'            
        ]);
        if($validator->fails()){    
            return response()->json($validator->errors(), 422);
        }
        //procurar se neste formulario a pergunta referida já foi respondida antes
        $pergunta = Models\Resposta::where('formulario_id', $request->formulario_id)
        ->where('pergunta_id', $request->pergunta_id)
        ->first();
        if(!$pergunta){
            Models\Resposta::adicionar($request);
            $msg = 'Resposta registrada!';            
        }else{
            Models\Resposta::editar($pergunta, $request);
            $msg = 'Resposta editada!';
        }        
        $qtd_perguntas_respondidas = Models\Resposta::where('formulario_id', $request->formulario_id)->count();
        return response()->json(['mensagem' => $msg, 'qtd' => $qtd_perguntas_respondidas], 200);
    }

    public function listar_respostas($formulario_id){
        $respostas = Models\Resposta::with([
            'usuario',
            'pergunta'
        ])->where('formulario_id', $formulario_id)->get();
        return response()->json($respostas, 200);
    }

    public function excluir_resposta($resposta_id){
        $resposta = Models\Resposta::find($resposta_id);
        if(!$resposta){
            return response()->json('Resposta não encontrada!', 404);
        }
        $resposta->delete();
        return response()->json('Resposta deletada!', 200);
    }

    public function adicionar(Request $request){              
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:255',
            'tipo_empreendimento_id' => 'required',
            'projeto_id' => 'required'            
        ]);
        if($validator->fails()){    
            return response()->json($validator->errors(), 422);
        }                
        Models\Auditoria::registrar_atividade('Cadastro de Formulário');        
        Models\Formulario::adicionar($request);
        return response()->json('Formulário cadastrado com sucesso!', 200);
    }

    public function editar($projeto_id, Request $request){              
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:255',
            'data_projeto' => 'required',
            'tipos_empreendimentos' => 'required',
            'funcionarios' => 'required'
        ]);      
        if($validator->fails()){    
            return response()->json($validator->errors(), 422);
        }                
        Models\Auditoria::registrar_atividade('Edição de Projeto');        
        Models\Projeto::editar($projeto_id, $request);
        return response()->json('Projeto editado com sucesso!', 200);
    }

    public function pesquisar($parametro, $valor){        
        return Models\Projeto::with([
            'tipos_empreendimentos.tipo_empreendimento',
            'usuarios.usuario'
        ])
        ->where($parametro, "like", "%$valor%")
        ->orderBy('nome', 'asc')
        ->get();
    }

    public function detalhes($usuario_id){
        return Models\Projeto::with([
            'tipos_empreendimentos.tipo_empreendimento',
            'usuarios.usuario'
        ])
        ->find($usuario_id);
    }
}
