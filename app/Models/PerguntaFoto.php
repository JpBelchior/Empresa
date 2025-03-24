<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerguntaFoto extends Model
{
    protected $table = 'pergunta_foto';

    protected $fillable = [
        'pergunta_id',
        'arquivo_id',
        'legenda'        
    ];    

    public function arquivo(){
        return $this->belongsTo(Arquivo::class, 'arquivo_id');
    }
}
