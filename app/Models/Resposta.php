<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models;

class Resposta extends Model
{
    protected $table = 'respostas';

    protected $fillable = [
        'resposta',
        'data_cadastro',
        'pergunta_id',  
        'formulario_id',
        'respondido_por_usuario_id',
        'arquivo_id'
    ];    

    public function pergunta(){
        return $this->belongsTo(Pergunta::class, 'pergunta_id');
    }

    public function usuario(){
        return $this->belongsTo(User::class, 'respondido_por_usuario_id');
    }

    public function formulario(){
        return $this->belongsTo(Formulario::class, 'formulario_id');
    }

    public static function adicionar($dados){
        $arquivo = null;        
        if($dados->hasFile("foto")){            
            $foto = $dados->file("foto");
            $arquivo = Models\Arquivo::adicionar($foto)->id;
        }
        return self::create([
            'resposta' => $dados->resposta,
            'pergunta_id' => $dados->pergunta_id,
            'formulario_id' => $dados->formulario_id,
            'respondido_por_usuario_id' => Auth::id(),
            'arquivo_id' => $arquivo,
            'data_cadastro' => now()
        ]);
    }

    public static function editar($pergunta, $dados){        
        $arquivo = $pergunta->arquivo_id;        
        if($dados->hasFile("foto")){
            if($arquivo != null){
                $pergunta->update(['arquivo_id' => null]);
                Models\Arquivo::excluir($arquivo);
            }
            $foto = $dados->file("foto");
            $arquivo = Models\Arquivo::adicionar($foto)->id;
        }
        return $pergunta->update([
            'resposta' => $dados->resposta,
            'arquivo_id' => $arquivo,
            'respondido_por_usuario_id' => Auth::id()
        ]);
    }
}
