<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerguntaTag extends Model
{
    protected $table = 'pergunta_tag';

    protected $fillable = [
        'pergunta_id',
        'tag_id',        
    ];

    public function tag(){
        return $this->belongsTo(Tag::class, 'tag_id');
    }
}
