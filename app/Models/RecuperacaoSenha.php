<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecuperacaoSenha extends Model
{
    protected $table = 'recuperacao_senha';

    protected $fillable = [
        'token',
        'data_cadastro',
        'data_expiracao',                
        'usado',
        'usuario_id'
    ];

    public function informacao_usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public static function adicionar_recuperacao_senha($token, $usuario){        
        self::create([
            'token' => $token,                        
            'data_expiracao' => date('Y-m-d H:i:s', strtotime('+10 minutes')),
            'usuario_id' => $usuario
        ]);
    }

    public static function usar_recuperacao($token){
        $recuperacao = self::where('token', $token)->first();
        $recuperacao->update([
            'usado' => true,            
        ]);
        return $recuperacao;
    }
}
