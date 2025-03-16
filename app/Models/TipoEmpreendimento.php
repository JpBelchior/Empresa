<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoEmpreendimento extends Model
{
    protected $table = 'tipos_empreendimentos';

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

    public static function editar(string $tipo_empreendimento_id, $dados){
        return self::find($tipo_empreendimento_id)->update([
            'nome' => $dados->nome,            
            'ativo' => $dados->ativo
        ]);
    }
}
