<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Resposta extends Model
{
    protected $table = 'respostas';

    protected $fillable = [
        'resposta',
        'data_cadastro',
        'pergunta_id',  
        'formulario_id',
        'respondido_por_usuario_id'      
    ];    

    public function pergunta(){
        return $this->belongsTo(Pergunta::class, 'pergunta_id');
    }

    public function usuario(){
        return $this->belongsTo(User::class, 'respondido_por_usuario_id');
    }

    public static function adicionar($dados){
        return self::create([
            'resposta' => $dados->resposta,
            'pergunta_id' => $dados->pergunta_id,
            'formulario_id' => $dados->formulario_id,
            'respondido_por_usuario_id' => Auth::id()
        ]);
    }

    public static function editar($pergunta, $dados){
        return $pergunta->update([
            'resposta' => $dados->resposta,            
            'respondido_por_usuario_id' => Auth::id()
        ]);
    }
}
