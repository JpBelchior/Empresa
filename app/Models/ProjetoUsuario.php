<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjetoUsuario extends Model
{
    protected $table = 'projeto_usuario';

    protected $fillable = [
        'projeto_id',
        'usuario_id',        
    ];

    public function usuario(){
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
