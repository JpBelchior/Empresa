<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';

    protected $fillable = [
        'nome',
        'ativo',
        'data_cadastro'
    ];

    public static function adicionar($dados){
        return self::create([
            'nome' => $dados->nome,            
            'ativo' => true,            
        ]);
    }

    public static function editar(string $topico_id, $dados){
        return self::find($topico_id)->update([
            'nome' => $dados->nome,            
            'ativo' => $dados->ativo
        ]);
    }
}
