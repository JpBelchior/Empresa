<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UsuarioController extends Controller
{
    use AuthorizesRequests;
    
    public function index(){                
        return view('usuarios.index');
    }

    public function lista(){
        return Models\User::with(['empresa'])->where('atribuicao', '!=', 'administrador')->orderBy('nome', 'asc')->get();
    }

    public function adicionar(Request $request){        
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:255',
            'cpf_cnpj' => 'required',
            'email' => 'required|max:255',
            'whatsapp' => 'required|max:255',            
            'empresa_id' => 'required',            
            'atribuicao' => 'required'
        ]);
        if($validator->fails()){    
            return response()->json($validator->errors(), 422);
        }        
        if(!validar_cpf_cnpj($request->cpf_cnpj)){
            return response()->json('CPF/CNPJ é inválido!', 422);
        }
        $usuario_com_mesmo_cpf_cnpj = Models\User::where('cpf_cnpj', $request->cpf_cnpj)->first();
        if($usuario_com_mesmo_cpf_cnpj){
            return response()->json("Usuário $usuario_com_mesmo_cpf_cnpj->nome possui este CPF/CNPJ!", 422);
        }
        $usuario_com_mesmo_email = Models\User::where('email', $request->email)->first();
        if($usuario_com_mesmo_email){
            return response()->json("Usuário $usuario_com_mesmo_email->nome possui este email!", 422);
        }        
        Models\Auditoria::registrar_atividade('Cadastro de Usuário');
        Models\User::adicionar($request);
        return response()->json('Usuário cadastrado com sucesso!', 200);
    }

    public function editar($usuario_id, Request $request){        
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:255',
            'cpf_cnpj' => 'required',
            'email' => 'required|max:255',
            'whatsapp' => 'required|max:255',            
            'empresa_id' => 'required',            
            'atribuicao' => 'required'
        ]);        
        if($validator->fails()){    
            return response()->json($validator->errors(), 422);
        }        
        if(!validar_cpf_cnpj($request->cpf_cnpj)){
            return response()->json('CPF/CNPJ é inválido!', 422);
        }
        $usuario_com_mesmo_cpf_cnpj = Models\User::where('cpf_cnpj', $request->cpf_cnpj)->where('id', '!=', $usuario_id)->first();
        if($usuario_com_mesmo_cpf_cnpj){
            return response()->json("Usuário $usuario_com_mesmo_cpf_cnpj->nome possui este CPF/CNPJ!", 422);
        }
        $usuario_com_mesmo_email = Models\User::where('email', $request->email)->where('id', '!=', $usuario_id)->first();
        if($usuario_com_mesmo_email){
            return response()->json("Usuário $usuario_com_mesmo_email->nome possui este email!", 422);
        }
        if($request->senha){
            if(mb_strlen($request->senha) < 6){
                return response()->json("A senha de usuário deve conter no mínimo 6 caracteres!", 422);
            }
            Models\User::alterar_senha_usuario($usuario_id, $request->senha);
        }
        Models\Auditoria::registrar_atividade('Edição de Usuário');
        Models\User::editar($usuario_id, $request);
        return response()->json('Usuário editado com sucesso!', 200);
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

    public function estatisticas(){
        $atribuicao = Auth::user()->atribuicao;
        $qtd_formularios = Models\Formulario::where('empresa_id', session('empresa_id'))->count();
        if($atribuicao == 'administrador' || $atribuicao == 'gerente' || $atribuicao == 'rh'){
            $qtd_projetos = Models\Projeto::where('empresa_id', session('empresa_id'))->count();            
        }else{
            $qtd_projetos = Models\ProjetoUsuario::where('usuario_id', Auth::id())->count();                       
        }        
        $dados = [
            'projetos' => $qtd_projetos,
            'formularios' => $qtd_formularios
        ];
        return response()->json($dados,200);
    }
}
