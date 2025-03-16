<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tematica extends Model
{
    protected $table = 'tematicas';

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

    public static function editar(string $tematica_id, $dados){
        return self::find($tematica_id)->update([
            'nome' => $dados->nome,            
            'ativo' => $dados->ativo
        ]);
    }
}
