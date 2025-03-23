<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models;
use Illuminate\Support\Facades\Log;

class Pergunta extends Model
{
    protected $table = 'perguntas';

    protected $fillable = [
        'titulo',
        'ativo',
        'tematica_id',
        'data_cadastro'
    ];

    public function tematica(){
        return $this->belongsTo(Tematica::class, 'tematica_id');
    }

    public function tipos_empreendimentos()
    {
        return $this->hasMany(PerguntaTipoEmpreendimento::class, 'pergunta_id');
    }

    public function topicos()
    {
        return $this->hasMany(PerguntaTopico::class, 'pergunta_id');
    }

    public function areas()
    {
        return $this->hasMany(PerguntaArea::class, 'pergunta_id');
    }

    public function tags()
    {
        return $this->hasMany(PerguntaTag::class, 'pergunta_id');
    }

    public static function adicionar($dados){
        $pergunta = self::create([
            'titulo' => $dados->titulo,  
            'tematica_id' => $dados->tematica_id,          
            'ativo' => true,            
        ]);
        self::cadastrar_segmentos_pergunta($pergunta, $dados);
    }

    public static function editar(string $pergunta_id, $dados){
        $pergunta = self::find($pergunta_id);
        $pergunta->update([
            'titulo' => $dados->titulo,  
            'tematica_id' => $dados->tematica_id,          
            'ativo' => $dados->ativo,            
        ]);
        Models\PerguntaTipoEmpreendimento::where('pergunta_id', $pergunta_id)->delete();        
        Models\PerguntaTopico::where('pergunta_id', $pergunta_id)->delete();
        Models\PerguntaArea::where('pergunta_id', $pergunta_id)->delete();
        Models\PerguntaTag::where('pergunta_id', $pergunta_id)->delete();
        self::cadastrar_segmentos_pergunta($pergunta, $dados);
    }

    private static function cadastrar_segmentos_pergunta($pergunta, $dados){
        foreach($dados->tipos_empreendimentos as $t){
            Models\PerguntaTipoEmpreendimento::create([
                'pergunta_id' => $pergunta->id,
                'tipo_empreendimento_id' => $t
            ]);
        }
        foreach($dados->topicos as $t){
            Models\PerguntaTopico::create([
                'pergunta_id' => $pergunta->id,
                'topico_id' => $t
            ]);
        }
        foreach($dados->areas as $t){
            Models\PerguntaArea::create([
                'pergunta_id' => $pergunta->id,
                'area_id' => $t
            ]);
        }
        foreach($dados->tags as $t){
            Models\PerguntaTag::create([
                'pergunta_id' => $pergunta->id,
                'tag_id' => $t
            ]);
        }
    }    
}
