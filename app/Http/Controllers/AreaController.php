<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AreaController extends Controller
{
    use AuthorizesRequests;
    
    public function index(){                
        return view('areas.index');
    }

    public function lista(){
        return Models\Area::orderBy('nome', 'asc')->get();
    }

    public function adicionar(Request $request){
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:255',            
        ]);
        if($validator->fails()){            
            return response()->json($validator->errors(), 422);
        }        
        Models\Auditoria::registrar_atividade('Cadastro de Área');
        Models\Area::adicionar($request);
        return response()->json('Área cadastrada com sucesso!', 200);
    }

    public function editar($area_id, Request $request){        
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:255',            
        ]);
        if($validator->fails()){            
            return response()->json($validator->errors(), 422);
        }        
        Models\Auditoria::registrar_atividade('Edição de Área');
        Models\Area::editar($area_id, $request);
        return response()->json('Área editado com sucesso!', 200);
    }

    public function detalhes($area_id){
        return Models\Area::find($area_id);
    }
}
