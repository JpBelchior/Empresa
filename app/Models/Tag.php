<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';

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

    public static function editar(string $tag_id, $dados){
        return self::find($tag_id)->update([
            'nome' => $dados->nome,            
            'ativo' => $dados->ativo
        ]);
    }
}
