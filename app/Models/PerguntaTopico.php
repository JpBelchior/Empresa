<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerguntaTopico extends Model
{
    protected $table = 'pergunta_topico';

    protected $fillable = [
        'pergunta_id',
        'topico_id',        
    ];

    public function topico(){
        return $this->belongsTo(Topico::class, 'topico_id');
    }
}
