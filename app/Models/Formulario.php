<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Formulario extends Model
{
    protected $table = 'formularios';

    protected $fillable = [
        'nome',
        'tipo_empreendimento_id',
        'empresa_id',
        'projeto_id',
        'criado_por_usuario_id',
        'data_cadastro'
    ];

    public function projeto(){
        return $this->belongsTo(Projeto::class, 'projeto_id');
    }

    public function tipo_empreendimento(){
        return $this->belongsTo(TipoEmpreendimento::class, 'tipo_empreendimento_id');
    }

    public function criador(){
        return $this->belongsTo(User::class, 'criado_por_usuario_id');
    }

    public function respostas(){
        return $this->belongsTo(Resposta::class, 'formulario_id');
    }

    public static function adicionar($dados){
        return self::create([
            'nome' => $dados->nome,       
            'tipo_empreendimento_id' => $dados->tipo_empreendimento_id,
            'projeto_id' => $dados->projeto_id,
            'empresa_id' => session('empresa_id'),
            'criado_por_usuario_id' => Auth::id()
        ]);
    }

    public static function editar(string $tag_id, $dados){
        return self::find($tag_id)->update([
            'nome' => $dados->nome,            
            'ativo' => $dados->ativo
        ]);
    }
}
