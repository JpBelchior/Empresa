<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arquivo extends Model
{
    protected $table = 'arquivos';

    protected $fillable = [
        'nome',
        'tamanho',
        'caminho',
        'data_cadastro'
    ];

    public static function adicionar($arquivo){
        return self::create([
            'nome' => $arquivo->getClientOriginalName(),
            "tamanho" => $arquivo->getSize(),
            "caminho" => storage_path('app/private/' . $arquivo->store()),
            "data_cadastro" => now()
        ]);
    }

    public static function excluir($arquivo_id){
        $arquivo = self::find($arquivo_id);
        unlink($arquivo->caminho);
        $arquivo->delete();
    }
}
