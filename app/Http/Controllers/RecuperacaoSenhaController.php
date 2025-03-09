<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class RecuperacaoSenhaController extends Controller
{

    public function solicitar(Request $request){
        if(!$request->cpf_cnpj){
            return response()->json('CPF/CNPJ não informado!', 422);
        }
        $usuario = Models\User::where('cpf_cnpj', $request->cpf_cnpj)->first();
        if(!$usuario){
            return response()->json('Usuário não informado!', 404);
        }
        if(!$usuario->ativo){
            return response()->json('Acesso negado!', 403);
        }
        $token = bin2hex(random_bytes(50));
        $html = view('email.recuperacao_senha',
        [
            'nome' => $usuario->nome,
            'momento_solicitacao' => date('d/m/Y H:i:s'),
            'momento_expiracao' => date('d/m/Y H:i:s', strtotime('+10 minutes')),
            'link' => getenv('APP_URL').'/recuperacao_senha/formulario/'.$token
        ]);
        $enviar_email = enviar_email($usuario->email, 'Recuperação de senha', $html);
        if(!$enviar_email){
            return response()->json('Não foi possível solicitar sua recuperacao de email.', 503);
        }
        Models\RecuperacaoSenha::adicionar_recuperacao_senha($token, $usuario->id);
        return response()->json('Verifique a sua caixa de email!', 200);
    }   
    
    public function formulario($token){        
        $viavel = $this->verificar_viabilidade_recuperacao($token);
        if(!$viavel){
            return redirect('/');
        }
        return view('login.recuperacao_senha', ['token' => $token]);        
    }

    public function efetivar(Request $request){
        $viavel = $this->verificar_viabilidade_recuperacao($request->token);
        if(!$viavel){
            return response()->json('Refaça a solicitação de recuperação de senha!', 403);
        }
        $validator = Validator::make($request->all(), [
            'senha' => 'required|min:6',
            'senha_confirmacao' => 'required|min:6',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        if($request->senha != $request->senha_confirmacao){
            return response()->json('Senhas não coincidem', 400);
        }
        $recuperacao = Models\RecuperacaoSenha::usar_recuperacao($request->token);                
        Models\User::alterar_senha_usuario($recuperacao->usuario_id, $request->senha);
        return response()->json('Senha alterada com sucesso!', 200);
    }

    private function verificar_viabilidade_recuperacao($token){        
        $recuperacao = Models\RecuperacaoSenha::with('informacao_usuario')->where('token', $token)->first();        
        if(!$recuperacao || $recuperacao->data_expiracao < now() || !$recuperacao->informacao_usuario->ativo || $recuperacao->usado){
            return false;
        }
        return true;
    }
}