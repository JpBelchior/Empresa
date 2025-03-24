<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models;

class ArquivoController extends Controller
{
    public function download($arquivo_id){
        $arquivo = $this->verificar_existencia_arquivo($arquivo_id);
        if(!$arquivo){
            abort(404);
        }
        return response()->download($arquivo->caminho, $arquivo->nome);
    }

    public function excluir($arquivo_id){
        $arquivo = $this->verificar_existencia_arquivo($arquivo_id);
        if(!$arquivo){
            abort(404);
        }
        unlink($arquivo->caminho);
        $arquivo->delete();
    }

    public function exibir($imagem = null){
        $arquivo = Models\Arquivo::find($imagem);
        if(!$arquivo){            
            $caminho = public_path('img/semimagem.jpg');
        }else{
            if(!file_exists($arquivo->caminho)){                
                $caminho = public_path('img/semimagem.jpg');
            }else{                
                $caminho = $arquivo->caminho;
            }
        }        
        $conteudo = file_get_contents('file://'.$caminho);
        header('Content-Type:' . mime_content_type($caminho));
        echo $conteudo;
    }

    private function verificar_existencia_arquivo($arquivo_id){
        $arquivo = Models\Arquivo::find($arquivo_id);
        if(!$arquivo){
            return false;
        }        
        if(!file_exists($arquivo->caminho)){
            return false;
        }
        return $arquivo;
    }
}
