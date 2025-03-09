<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Auditoria extends Model
{    

    protected $table = 'auditorias';

    protected $fillable = [
        'nome_acao',
        'ip',
        'detalhes',
        'usuario_id'        
    ];

    public static function registrar_atividade($nome_acao, $detalhes = null){
        self::create([
            'nome_acao' => $nome_acao,
            'ip' => pegarIpUsuario(),
            'detalhes' => $detalhes,
            'usuario_id' => Auth::id()
        ]);
    }
}
