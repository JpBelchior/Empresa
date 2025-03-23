<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerguntaTipoEmpreendimento extends Model
{
    protected $table = 'pergunta_tipo_empreendimento';

    protected $fillable = [
        'pergunta_id',
        'tipo_empreendimento_id',        
    ];

    public function tipo_empreendimento(){
        return $this->belongsTo(TipoEmpreendimento::class, 'tipo_empreendimento_id');
    }
}
