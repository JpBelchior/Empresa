<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'nome',
        'empresa_id',
        'ativo',
        'data_cadastro'
    ];

    public static function adicionar($dados){
        return self::create([
            'nome' => $dados->nome,            
            'empresa_id' => session('empresa_id'),
            'ativo' => true,            
        ]);
    }

    public static function editar(string $cliente_id, $dados){
        return self::find($cliente_id)->update([
            'nome' => $dados->nome,
            'ativo' => $dados->ativo
        ]);
    }
}
