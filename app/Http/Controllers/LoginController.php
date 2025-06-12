<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{

    public function verificar_login(Request $request)
    {        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'senha' => 'required',
        ]);
        if($validator->fails()){            
            return response()->json($validator->errors(), 422);
        }        
        $usuario = Models\User::where('email', $request->email)->first();        
        if(!$usuario){            
            return response()->json('Usuário não encontrado!', 422);
        }
        if(!$usuario->ativo){
            Models\Auditoria::registrar_atividade('Tentativa de acesso de usuário inativo');
            return response()->json('Acesso negado!', 403);
        }
        $autenticou = password_verify($request->senha, $usuario->senha);           
        if(!$autenticou){
            return response()->json('Senha incorreta!', 403);
        }
        Auth::login($usuario);
        $empresa_id = $usuario->empresa_id;        
        if($usuario->atribuicao == 'administrador'){
            $empresa_id = Models\Empresa::first()->id;
        }
        $empresa = Models\Empresa::find($empresa_id);
        session([
            'nome_usuario' => $usuario->nome, 
            'email_usuario' => $usuario->email,
            'atribuicao_usuario' => ucfirst($usuario->atribuicao),
            'empresa_id' => $empresa_id,
            'nome_empresa' => $empresa->razao_social,
            'limite_usuarios_empresa' => $empresa->qtd_usuarios_permitidos
        ]);
        Models\Auditoria::registrar_atividade("Login");
        $request->session()->regenerateToken();
        session(["primeira_sessao" => "Dashboard", "segunda_sessao" => "Estatísticas"]);
        return response()->json('Seja bem vindo!', 200);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        response()->json(['success' => true, 'message' => 'Você foi desconectado com sucesso.']);
        return redirect('/');
    }
}