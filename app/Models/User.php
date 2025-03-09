<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'nome',
        'email',
        'senha',
        'cpf_cnpj',
        'atribuicao',
        'ativo',
        'whatsapp',
        'empresa_id'
    ];

    public static function alterar_senha_usuario($usuario, $senha){        
        self::find($usuario)->update(['senha' => password_hash($senha, PASSWORD_DEFAULT)]);
    }    
}
