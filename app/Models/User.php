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

    public function empresa(){
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public static function alterar_senha_usuario($usuario, $senha){        
        self::find($usuario)->update(['senha' => password_hash($senha, PASSWORD_DEFAULT)]);
    }    

    public static function adicionar($dados){
        return self::create([
            'nome' => $dados->nome,
            'email' => $dados->email,
            'cpf_cnpj' => $dados->cpf_cnpj,
            'atribuicao' => $dados->atribuicao,            
            'whatsapp' => $dados->whatsapp,
            'empresa_id' => $dados->empresa_id
        ]);
    }

    public static function editar(string $usuario_id, $dados){
        return self::find($usuario_id)->update([
            'nome' => $dados->nome,
            'email' => $dados->email,
            'cpf_cnpj' => $dados->cpf_cnpj,
            'atribuicao' => $dados->atribuicao,            
            'whatsapp' => $dados->whatsapp,
            'ativo' => $dados->ativo,
            'empresa_id' => $dados->empresa_id
        ]);
    }
}
