<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresas';

    protected $fillable = [
        'razao_social',
        'cnpj',
        'ativo',
        'email',
        'whatsapp',
        'qtd_usuarios_permitidos',
        'data_cadastro'
    ];

    public static function adicionar($dados){
        return self::create([
            'razao_social' => $dados->razao_social,
            'cnpj' => $dados->cnpj,
            'ativo' => true,
            'email' => $dados->email,
            'whatsapp' => $dados->whatsapp,
            'qtd_usuarios_permitidos' => $dados->limite_usuarios,
        ]);
    }

    public static function editar(string $empresa_id, $dados){
        return self::find($empresa_id)->update([
            'razao_social' => $dados->razao_social,
            'cnpj' => $dados->cnpj,
            'ativo' => true,
            'email' => $dados->email,
            'whatsapp' => $dados->whatsapp,
            'qtd_usuarios_permitidos' => $dados->limite_usuarios,
            'ativo' => $dados->ativo
        ]);
    }
}
