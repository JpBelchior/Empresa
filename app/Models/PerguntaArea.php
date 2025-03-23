<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerguntaArea extends Model
{
    protected $table = 'pergunta_area';

    protected $fillable = [
        'pergunta_id',
        'area_id',        
    ];

    public function area(){
        return $this->belongsTo(Area::class, 'area_id');
    }
}
