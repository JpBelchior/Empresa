<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EmpresaController extends Controller
{
    use AuthorizesRequests;
    
    public function index(){                
        return view('empresas.index');
    }

    public function lista(){
        return Models\Empresa::orderBy('razao_social', 'asc')->get();
    }

    public function adicionar(Request $request){
        $validator = Validator::make($request->all(), [
            'razao_social' => 'required',
            'cnpj' => 'required',
            'email' => 'required|email',
            'whatsapp' => 'required',
            'limite_usuarios' => 'required|min:1',
        ]);
        if($validator->fails()){            
            return response()->json($validator->errors(), 422);
        }
        if(!validar_cnpj($request->cnpj)){
            return response()->json('CNPJ inválido!', 422);
        }
        $empresa_com_mesmo_cnpj = Models\Empresa::where('cnpj', $request->cnpj)->first();
        if($empresa_com_mesmo_cnpj){
            return response()->json($empresa_com_mesmo_cnpj->razao_social." já possui este CNPJ!", 422);
        }
        Models\Auditoria::registrar_atividade('Cadastro de empresa');
        Models\Empresa::adicionar($request);
        return response()->json('Empresa cadastrada com sucesso!', 200);
    }

    public function editar($empresa_id, Request $request){        
        $validator = Validator::make($request->all(), [
            'razao_social' => 'required',
            'cnpj' => 'required',
            'email' => 'required|email',
            'whatsapp' => 'required',
            'limite_usuarios' => 'required|min:1',
        ]);
        if($validator->fails()){            
            return response()->json($validator->errors(), 422);
        }
        if(!validar_cnpj($request->cnpj)){
            return response()->json('CNPJ inválido!', 422);
        }
        $empresa = Models\Empresa::find($empresa_id);
        if(!$empresa){
            return response()->json('Empresa não encontrada!', 404);
        }        
        $empresa_com_mesmo_cnpj = Models\Empresa::where('id', '!=', $empresa_id)->where('cnpj', $request->cnpj)->first();
        if($empresa_com_mesmo_cnpj){
            return response()->json($empresa_com_mesmo_cnpj->razao_social." já possui este CNPJ!", 422);
        }
        Models\Auditoria::registrar_atividade('Edição de empresa');
        Models\Empresa::editar($empresa_id, $request);
        return response()->json('Empresa editada com sucesso!', 200);
    }

    public function detalhes($empresa_id){
        return Models\Empresa::find($empresa_id);
    }

    public function trocar_empresa(Request $request){
        $empresa = Models\Empresa::find($request->empresa_id);
        if(!$empresa){
            return response()->json("Empresa não encontrada!", 200);
        }
        session([
            'nome_empresa' => $empresa->razao_social,
            'empresa_id' => $empresa->id,
            'limite_usuarios_empresa' => $empresa->qtd_usuarios_permitidos
        ]);
    }
}
