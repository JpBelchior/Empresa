<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models;

class Resposta extends Model
{
    protected $table = 'respostas';

    protected $fillable = [
        'resposta',

        'nivel_adequacao',
        'nivel_probabilidade',
        'nivel_impacto',
        'nivel_esforco',
        'nivel_valor',
        'esta_em_vulnerabilidade',
        'vulnerabilidade_vigente',
        'esta_em_risco_altissimo',
        'risco_altissimo_vigente',
        'prazo',                

        'data_cadastro',
        'pergunta_id',
        'formulario_id',
        'respondido_por_usuario_id',
        'arquivo_id'
    ];

    public function pergunta()
    {
        return $this->belongsTo(Pergunta::class, 'pergunta_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'respondido_por_usuario_id');
    }

    public function formulario()
    {
        return $this->belongsTo(Formulario::class, 'formulario_id');
    }

    public static function adicionar($dados)
    {
        $arquivo = null;
        if ($dados->hasFile("foto")) {
            $foto = $dados->file("foto");
            $arquivo = Models\Arquivo::adicionar($foto)->id;
        }        
        self::create([
            'resposta' => $dados->resposta,
            'pergunta_id' => $dados->pergunta_id,
            'formulario_id' => $dados->formulario_id,
            'respondido_por_usuario_id' => Auth::id(),
            'arquivo_id' => $arquivo,
            'data_cadastro' => now(),
            'nivel_adequacao' => $dados->adequacao,
            'nivel_probabilidade' => $dados->probabilidade,
            'nivel_impacto' => $dados->impacto,
            'nivel_esforco' => $dados->esforco,
            'nivel_valor' => $dados->valor,
            'esta_em_vulnerabilidade' => $dados->vulneravel,
            'vulnerabilidade_vigente' => getenv('VITE_VULNERABILIDADE'),
            'esta_em_risco_altissimo' => $dados->risco_altissimo,
            'risco_altissimo_vigente' => getenv('VITE_RISCO_ALTISSIMO'),
            'prazo' => self::determinar_prazo($dados->esforco, $dados->valor)
        ]);
        self::atualizar_metadados_formulario($dados->formulario_id);        
        Models\Projeto::atualizar_estatisticas_projeto($dados->formulario_id);
    }

    public static function editar($pergunta, $dados)
    {
        $arquivo = $pergunta->arquivo_id;
        if ($dados->hasFile("foto")) {
            if ($arquivo != null) {
                $pergunta->update(['arquivo_id' => null]);
                Models\Arquivo::excluir($arquivo);
            }
            $foto = $dados->file("foto");
            $arquivo = Models\Arquivo::adicionar($foto)->id;
        }
        $pergunta->update([
            'resposta' => $dados->resposta,
            'arquivo_id' => $arquivo,
            'respondido_por_usuario_id' => Auth::id(),
            'nivel_adequacao' => $dados->adequacao,
            'nivel_probabilidade' => $dados->probabilidade,
            'nivel_impacto' => $dados->impacto,
            'nivel_esforco' => $dados->esforco,
            'nivel_valor' => $dados->valor,
            'esta_em_vulnerabilidade' => $dados->vulneravel,
            'vulnerabilidade_vigente' => getenv('VITE_VULNERABILIDADE'),
            'esta_em_risco_altissimo' => $dados->risco_altissimo,
            'risco_altissimo_vigente' => getenv('VITE_RISCO_ALTISSIMO'),
            'prazo' => self::determinar_prazo($dados->esforco, $dados->valor)
        ]);
        self::atualizar_metadados_formulario($dados->formulario_id);
        Models\Projeto::atualizar_estatisticas_projeto($dados->formulario_id);
    }

    private static function determinar_prazo($esforco, $valor)
    {        
        $curto_prazo_minimo = getenv("VITE_CURTO_PRAZO_MINIMO");
        $curto_prazo_maximo = getenv("VITE_CURTO_PRAZO_MAXIMO");
        $medio_prazo_maximo = getenv("VITE_MEDIO_PRAZO_MAXIMO");
        $medio_prazo_minimo = getenv("VITE_MEDIO_PRAZO_MINIMO");
        $longo_prazo_maximo = getenv("VITE_LONGO_PRAZO_MAXIMO");
        $longo_prazo_minimo = getenv("VITE_LONGO_PRAZO_MINIMO");
        $multiplicacao = $esforco * $valor;        
        if ($multiplicacao >= $curto_prazo_minimo && $multiplicacao <= $curto_prazo_maximo) {
            $prazo = "Curto prazo";
        } elseif ($multiplicacao >= $medio_prazo_minimo && $multiplicacao <= $medio_prazo_maximo) {
            $prazo = "Médio prazo";
        } elseif ($multiplicacao >= $longo_prazo_minimo && $multiplicacao <= $longo_prazo_maximo) {
            $prazo = "Longo prazo";
        }
        return $prazo;
    }

    private static function atualizar_metadados_formulario($formulario_id){
        $formulario = Models\Formulario::find($formulario_id);
        $total_perguntas = Models\Formulario::recuperar_total_perguntas_formulario($formulario->projeto_id);        
        $total_perguntas_respondidas = Models\Resposta::where('formulario_id', $formulario_id)->count();
        $porcentagem_preenchimento = ($total_perguntas_respondidas/$total_perguntas)*100;        
        $formulario->update([
            'total_perguntas' => $total_perguntas,
            'total_perguntas_respondidas' => $total_perguntas_respondidas,
            'porcentagem_preenchimento' => $porcentagem_preenchimento,
            'total_vulnerabilidades' => Models\Resposta::where('formulario_id', $formulario_id)->where('esta_em_vulnerabilidade', true)->count(),
            'total_riscos_altissimos' => Models\Resposta::where('formulario_id', $formulario_id)->where('esta_em_risco_altissimo', true)->count(),
            'total_recomendacoes' => Models\Resposta::where('formulario_id', $formulario_id)->whereNotNull('resposta')->count()
        ]);
    }
}
