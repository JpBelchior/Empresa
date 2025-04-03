<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjetoTipoEmpreendimento extends Model
{
    protected $table = 'projeto_tipo_empreendimento';

    protected $fillable = [
        'projeto_id',
        'tipo_empreendimento_id',        
    ];

    public function tipo_empreendimento(){
        return $this->belongsTo(TipoEmpreendimento::class, 'tipo_empreendimento_id');
    }
}
