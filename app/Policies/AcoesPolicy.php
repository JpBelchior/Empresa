<?php

namespace App\Policies;

use App\Models\User;

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
}
