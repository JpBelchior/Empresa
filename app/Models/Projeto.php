<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models;

class Projeto extends Model
{
    protected $table = 'projetos';

    protected $fillable = [
        'nome',
        'data_projeto',
        'empresa_id',
        'data_cadastro'
    ];

    public static function adicionar($dados){        
        $projeto = self::create([
            'nome' => $dados->nome,
            'data_projeto' => $dados->data_projeto,
            'empresa_id' => Auth::user()->empresa_id
        ]);
        foreach($dados->tipos_empreendimentos as $t){
            Models\ProjetoTipoEmpreendimento::create([
                'projeto_id' => $projeto->id,
                'tipo_empreendimento_id' => $t
            ]);
        }
        foreach($dados->funcionarios as $f){
            Models\ProjetoUsuario::create([
                'projeto_id' => $projeto->id,
                'usuario_id' => $f
            ]);
        }
        return $projeto;
    }

    public static function editar(string $projeto_id, $dados){
        $projeto = self::find($projeto_id)->update([
            'nome' => $dados->nome,
            'data_projeto' => $dados->data_projeto,
            'empresa_id' => session('empresa_id')
        ]);        
        Models\ProjetoTipoEmpreendimento::where('projeto_id', $projeto_id)->delete();
        Models\ProjetoUsuario::where('projeto_id', $projeto_id)->delete();
        foreach($dados->tipos_empreendimentos as $t){
            Models\ProjetoTipoEmpreendimento::create([
                'projeto_id' => $projeto_id,
                'tipo_empreendimento_id' => $t
            ]);
        }
        foreach($dados->funcionarios as $f){
            Models\ProjetoUsuario::create([
                'projeto_id' => $projeto_id,
                'usuario_id' => $f
            ]);
        }
        return $projeto;
    }

    public function tipos_empreendimentos()
    {
        return $this->hasMany(ProjetoTipoEmpreendimento::class, 'projeto_id');
    }

    public function usuarios()
    {
        return $this->hasMany(ProjetoUsuario::class, 'projeto_id');
    }
}
