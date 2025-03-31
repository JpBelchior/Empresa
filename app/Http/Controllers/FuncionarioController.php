<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FuncionarioController extends Controller
{
    use AuthorizesRequests;
    
    public function index(){                
        $dados = [
            'empresa' => Models\Empresa::select('razao_social', 'cnpj', 'qtd_usuarios_permitidos as limite')->find(Auth::user()->empresa_id)
        ];
        return view('funcionarios.index', $dados);
    }

    public function lista(){
        return Models\User::where('atribuicao', '!=', 'administrador')->where('empresa_id', Auth::user()->empresa_id)->orderBy('nome', 'asc')->get();
    }

    public function adicionar(Request $request){                
        $usuario_config = Auth::user();
        if($usuario_config->atribuicao != 'rh'){
            abort(403);
        }
        $empresa = Models\Empresa::find($usuario_config->empresa_id);
        $qtd_usuarios_empresa_atual = Models\User::where('empresa_id', $usuario_config->empresa_id)->count();
        if($empresa->qtd_usuarios_permitidos == $qtd_usuarios_empresa_atual){
            return response()->json('O número de funcionários permitidos já foi atingido!', 422);
        }
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:255',
            'cpf_cnpj' => 'required',
            'email' => 'required|max:255',
            'whatsapp' => 'required|max:255',            
            'atribuicao' => 'required'
        ]);
        if($validator->fails()){    
            return response()->json($validator->errors(), 422);
        }        
        if(!validar_cpf_cnpj($request->cpf_cnpj)){
            return response()->json('CPF/CNPJ é inválido!', 422);
        }        
        $usuario_com_mesmo_cpf_cnpj = Models\User::where('cpf_cnpj', $request->cpf_cnpj)->where('empresa_id', $usuario_config->empresa_id)->first();
        if($usuario_com_mesmo_cpf_cnpj){
            return response()->json("Usuário $usuario_com_mesmo_cpf_cnpj->nome possui este CPF/CNPJ!", 422);
        }
        $usuario_com_mesmo_email = Models\User::where('email', $request->email)->where('empresa_id', $usuario_config->empresa_id)->first();
        if($usuario_com_mesmo_email){
            return response()->json("Usuário $usuario_com_mesmo_email->nome possui este email!", 422);
        }
        Models\Auditoria::registrar_atividade('Cadastro de Funcionário');
        $request->merge(['empresa_id' => $usuario_config->empresa_id]);
        Models\User::adicionar($request);
        return response()->json('Funcionário cadastrado com sucesso!', 200);
    }

    public function editar($usuario_id, Request $request){        
        $usuario_config = Auth::user();
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:255',
            'cpf_cnpj' => 'required',
            'email' => 'required|max:255',
            'whatsapp' => 'required|max:255',            
            'atribuicao' => 'required'
        ]);        
        if($validator->fails()){    
            return response()->json($validator->errors(), 422);
        }        
        if(!validar_cpf_cnpj($request->cpf_cnpj)){
            return response()->json('CPF/CNPJ é inválido!', 422);
        }
        $usuario_com_mesmo_cpf_cnpj = Models\User::where('cpf_cnpj', $request->cpf_cnpj)
        ->where('id', '!=', $usuario_id)
        ->where('empresa_id', $usuario_config->empresa_id)
        ->first();
        if($usuario_com_mesmo_cpf_cnpj){
            return response()->json("Usuário $usuario_com_mesmo_cpf_cnpj->nome possui este CPF/CNPJ!", 422);
        }
        $usuario_com_mesmo_email = Models\User::where('email', $request->email)
        ->where('id', '!=', $usuario_id)
        ->where('empresa_id', $usuario_config->empresa_id)
        ->first();
        if($usuario_com_mesmo_email){
            return response()->json("Usuário $usuario_com_mesmo_email->nome possui este email!", 422);
        }
        if($request->senha){
            if(mb_strlen($request->senha) < 6){
                return response()->json("A senha de usuário deve conter no mínimo 6 caracteres!", 422);
            }
            Models\User::alterar_senha_usuario($usuario_id, $request->senha);
        }
        Models\Auditoria::registrar_atividade('Edição de Funcionário');
        $request->merge(['empresa_id' => $usuario_config->empresa_id]);
        Models\User::editar($usuario_id, $request);
        return response()->json('Funcionário editado com sucesso!', 200);
    }

    public function pesquisar($parametro, $valor){
        if($parametro == 'ativo'){
            $ativo = $valor == 'true' ? true : false;
            return Models\User::where('ativo', $ativo)->orderBy('nome', 'asc')->get();    
        }
        return Models\User::where($parametro, "like", "%$valor%")->orderBy('nome', 'asc')->get();
    }

    public function detalhes($usuario_id){
        return Models\User::find($usuario_id);
    }
}
