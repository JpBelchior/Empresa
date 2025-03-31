<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class AcoesPolicy
{
    public function administrador(User $user)
    {                                        
        return $user->atribuicao === 'administrador';
    }

    public function ativo(User $user)
    {
        return $user->ativo;
    }

    public function habilitar_funcionario(User $user, array $tipo_funcionario){        
        if(in_array($user->atribuicao, $tipo_funcionario)){
            return true;
        }
        return false;
    }
}
