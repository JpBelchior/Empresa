<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Arquivo extends Model
{
    protected $table = 'arquivos';

    protected $fillable = [
        'nome',
        'tamanho',
        'caminho',
        'data_cadastro'
    ];

    public static function adicionar($arquivo){
        return self::create([
            'nome' => $arquivo->getClientOriginalName(),
            "tamanho" => $arquivo->getSize(),
            "caminho" => storage_path('app/private/' . $arquivo->store()),
            "data_cadastro" => now()
        ]);
    }

    public static function excluir($arquivo_id){
        $arquivo = self::find($arquivo_id);
        unlink($arquivo->caminho);
        $arquivo->delete();
    }

    public static function converter_imagem_base_64($imagem, $nome_imagem){
        if ($imagem->hasFile($nome_imagem)) {
            $imagem = $imagem->file($nome_imagem);
            $conteudo = base64_encode(file_get_contents($imagem->getRealPath()));
            $mime = $imagem->getMimeType();
            return "data:$mime;base64,$conteudo";
        }
        return null;
    }
}
