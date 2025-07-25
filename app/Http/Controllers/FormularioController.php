<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;
use App\Models\Arquivo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class FormularioController extends Controller
{
    use AuthorizesRequests;    

    public function __construct(){
        session(["primeira_sessao" => "Formulário"]);
    }
    
    public function index(){                        
        session(["segunda_sessao" => "Visão Geral"]);
        return view('formularios.index');
    }

    public function lista(){
        return Models\Formulario::with([            
            'criador',
            'projeto'
        ])
        ->where('empresa_id', session('empresa_id'))
        ->orderBy('data_cadastro', 'desc')->get();
    }

    public function interagir($formulario_id){
        $formulario = Models\Formulario::find($formulario_id);
        if(!$formulario){
            abort('404');
        }
        $tipos_empreendimento_projeto = Models\ProjetoTipoEmpreendimento::where('projeto_id', $formulario->projeto_id)->pluck('tipo_empreendimento_id')->toArray();
        $perguntas_ids = Models\PerguntaTipoEmpreendimento::whereIn('tipo_empreendimento_id', $tipos_empreendimento_projeto)->select('pergunta_id')->groupBy('pergunta_id')->pluck('pergunta_id')->toArray();
        $perguntas = Models\Pergunta::whereIn('id', $perguntas_ids)->orderBy('data_cadastro', 'desc')->get();                
        $dados = [
            'formulario' => $formulario,
            'perguntas' => $perguntas
        ];
        return view('formularios.interagir', $dados);
    }

    public function formulario($formulario_id){        
        session(["segunda_sessao" => "Preenchimento"]);
        $formulario = Models\Formulario::find($formulario_id);
        if(!$formulario){
            abort('404');
        }
        $tipos_empreendimento_projeto = Models\ProjetoTipoEmpreendimento::where('projeto_id', $formulario->projeto_id)->pluck('tipo_empreendimento_id')->toArray();
        $perguntas_ids = Models\PerguntaTipoEmpreendimento::whereIn('tipo_empreendimento_id', $tipos_empreendimento_projeto)->select('pergunta_id')->groupBy('pergunta_id')->pluck('pergunta_id')->toArray();
        $perguntas = Models\Pergunta::whereIn('id', $perguntas_ids)->orderBy('data_cadastro', 'desc')->get();
        for($i = 0; $i < count($perguntas); $i++){            
            $resposta = Models\Resposta::where('formulario_id', $formulario_id)
            ->where('pergunta_id', $perguntas[$i]->id)
            ->select("nivel_adequacao", "esta_em_risco_altissimo", "prazo", "arquivo_id")
            ->first();
            $nivel_adequacao = 0;
            $risco_altissimo = 'nao';
            $prazo = "Longo prazo";
            $respondido = false;
            $foto = false;
            if($resposta){      
                $respondido = true;          
                $nivel_adequacao = $resposta->nivel_adequacao; 
                $risco_altissimo = $resposta->esta_em_risco_altissimo ? 'sim' : 'nao';
                $prazo = $resposta->prazo;
                $foto = $resposta->arquivo_id;
            }            
            $perguntas[$i]->foto = $foto;
            $perguntas[$i]->respondido = $respondido;
            $perguntas[$i]->nivel_adequacao = $nivel_adequacao;             
            $perguntas[$i]->risco_altissimo = $risco_altissimo;
            $perguntas[$i]->prazo = $prazo;             
        }
        $dados = [
            'formulario' => $formulario,
            'perguntas' => $perguntas
        ];
        return view('formularios.formulario', $dados);
    }

    public function responder_pergunta(Request $request){        
        $pergunta = Models\Pergunta::find($request->pergunta_id);
        if(!$pergunta){
            return response()->json("Pergunta não encontrada!", 404);
        }
        $multiplicacao_risco_altissimo = $request->probabilidade*$request->impacto;
        $risco_altissimo = $multiplicacao_risco_altissimo >= getenv("VITE_RISCO_ALTISSIMO");
        if($risco_altissimo && $request->resposta == ''){
            return response()->json("Devido ao risco altíssimo [$multiplicacao_risco_altissimo], informe as recomendações.", 400);
        }
        //procurar se neste formulario a pergunta referida já foi respondida antes
        $pergunta = Models\Resposta::where('formulario_id', $request->formulario_id)
        ->where('pergunta_id', $request->pergunta_id)
        ->first();
        $request->merge([
            'vulneravel' => $request->adequacao >= getenv("VITE_VULNERABILIDADE"),
            'risco_altissimo' => $risco_altissimo
        ]);
        if(!$pergunta){
            Models\Resposta::adicionar($request);
            $msg = 'Resposta registrada!';            
        }else{
            Models\Resposta::editar($pergunta, $request);
            $msg = 'Resposta editada!';
        }        
        $qtd_perguntas_respondidas = Models\Resposta::where('formulario_id', $request->formulario_id)->count();
        return response()->json(['mensagem' => $msg, 'qtd' => $qtd_perguntas_respondidas], 200);
        
    }

    public function relatorio($formulario_id, $formato){
        $respostas = Models\Resposta::with([
            'usuario',
            'pergunta',
            'formulario'
        ])
        ->where('formulario_id', $formulario_id)
        ->orderBy('data_cadastro', 'desc')
        ->get();
        if(!$respostas){
            abort('404');
        }                
        $formulario = Models\Formulario::find($formulario_id);
        if($formato == 'pdf'){
            return view('formularios.relatorio', ['respostas' => $respostas, 'formulario' => $formulario]);
        }        
        if($formato == 'excel'){
            $spreadsheet = new Spreadsheet();
            $activeWorksheet = $spreadsheet->getActiveSheet();            
            $activeWorksheet->setTitle("Respostas");            
            $activeWorksheet->getColumnDimension('A')->setAutoSize(true);
            $activeWorksheet->getColumnDimension('B')->setAutoSize(true);
            $activeWorksheet->getColumnDimension('C')->setAutoSize(true);
            $activeWorksheet->getColumnDimension('D')->setAutoSize(true);                    
            $activeWorksheet->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('B')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('D')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);                    
            $activeWorksheet->setCellValue('A1', 'PERGUNTA');
            $activeWorksheet->setCellValue('B1', 'RESPOSTA');
            $activeWorksheet->setCellValue('C1', 'FUNCIONÁRIO');
            $activeWorksheet->setCellValue('D1', 'MOMENTO DA RESPOSTA');            
            $quantidade = count($respostas);
            if($quantidade > 0){
                for($i = 0; $i < $quantidade; $i++){
                    $celula = $i + 2;
                    $activeWorksheet->setCellValue('A'.$celula, $respostas[$i]->pergunta->titulo);
                    $activeWorksheet->setCellValue('B'.$celula, $respostas[$i]->resposta);
                    $activeWorksheet->setCellValue('C'.$celula, $respostas[$i]->usuario->nome);
                    $activeWorksheet->setCellValue('D'.$celula, formatar_data($respostas[$i]->data_cadastro));                    
                }
            }
            $writer = new Xlsx($spreadsheet);
            $filename = 'respostas.xlsx';
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header('Cache-Control: max-age=0');
            $writer->save('php://output');
            exit;
        }
    }

    public function registrar(Request $request){        
        $validator = Validator::make($request->all(), [
            'resposta' => 'required|max:10000',
            'pergunta_id' => 'required',
            'formulario_id' => 'required'            
        ]);
        if($validator->fails()){    
            return response()->json($validator->errors(), 422);
        }
        //procurar se neste formulario a pergunta referida já foi respondida antes
        $pergunta = Models\Resposta::where('formulario_id', $request->formulario_id)
        ->where('pergunta_id', $request->pergunta_id)
        ->first();
        if(!$pergunta){
            Models\Resposta::adicionar($request);
            $msg = 'Resposta registrada!';            
        }else{
            Models\Resposta::editar($pergunta, $request);
            $msg = 'Resposta editada!';
        }        
        $qtd_perguntas_respondidas = Models\Resposta::where('formulario_id', $request->formulario_id)->count();
        return response()->json(['mensagem' => $msg, 'qtd' => $qtd_perguntas_respondidas], 200);
    }

    public function registrar_perguntas_em_espera($formulario_id, Request $request){
        $formulario = Models\Formulario::find($formulario_id);
        if($formulario){
            $dados = $request->dados;                        
            foreach($dados as $d){
                $pergunta = Models\Resposta::where('formulario_id', $d['formulario_id'])
                ->where('pergunta_id', $d['pergunta_id'])
                ->first();
                $data = json_decode(json_encode($d));                
                if(!$pergunta){                                        
                    Models\Resposta::adicionar($data);                
                }else{                    
                    Models\Resposta::editar($pergunta, $data);
                }
            }            
        }
    }

    public function listar_respostas($formulario_id){
        $respostas = Models\Resposta::with([
            'usuario',
            'pergunta'
        ])->where('formulario_id', $formulario_id)->get();
        return response()->json($respostas, 200);
    }

    public function excluir_resposta($resposta_id){
        $resposta = Models\Resposta::find($resposta_id);
        if(!$resposta){
            return response()->json('Resposta não encontrada!', 404);
        }
        $arquivo = $resposta->arquivo_id;
        $resposta->delete();
        if($arquivo != null){
            Models\Arquivo::excluir($arquivo);
        }
        return response()->json('Resposta deletada!', 200);
    }

    public function adicionar(Request $request){              
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:255',            
            'projeto_id' => 'required'            
        ]);
        if($validator->fails()){    
            return response()->json($validator->errors(), 422);
        }                
        Models\Auditoria::registrar_atividade('Cadastro de Formulário');        
        Models\Formulario::adicionar($request);
        return response()->json('Formulário cadastrado com sucesso!', 200);
    }

    public function editar($projeto_id, Request $request){              
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:255',
            'data_projeto' => 'required',
            'tipos_empreendimentos' => 'required',
            'funcionarios' => 'required'
        ]);      
        if($validator->fails()){    
            return response()->json($validator->errors(), 422);
        }                
        Models\Auditoria::registrar_atividade('Edição de Projeto');        
        Models\Projeto::editar($projeto_id, $request);
        return response()->json('Projeto editado com sucesso!', 200);
    }

    public function pesquisar($parametro, $valor){        
        return Models\Projeto::with([
            'tipos_empreendimentos.tipo_empreendimento',
            'usuarios.usuario'
        ])
        ->where($parametro, "like", "%$valor%")
        ->orderBy('nome', 'asc')
        ->get();
    }

    public function detalhes($usuario_id){
        return Models\Projeto::with([
            'tipos_empreendimentos.tipo_empreendimento',
            'usuarios.usuario'
        ])
        ->find($usuario_id);
    }

    public function relatorio_personalizado(Request $request){        
        $request->validate([
            'relatorio_formulario_id' => 'required',
            'nome_empresa' => 'required|max:255',
            'nome_cliente' => 'required|max:255',
            'objetivo' => 'required|max:500',
            'observacoes' => 'required|max:500',
            'localizacao_analise' => 'required|max:255',
            'referencias_proximas' => 'required|max:255',
            'panorama' => 'required|max:255',
            'logo_empresa' => 'required|file',
            'logo_cliente' => 'required|file',
        ], 
        [
            'required' => 'O campo :attribute é obrigatório.',
            'max' => 'O campo :attribute deve ter no máximo :max caracteres.',
            'logo_empresa.file' => 'Você precisa enviar o arquivo da logo da empresa.',
            'logo_cliente.file' => 'Você precisa enviar o arquivo da logo do cliente.',
            'imagem_area.file' => 'Você precisa enviar o arquivo da localização da análise.',
        ]);
        $dados = [
            'dados' => $request,
            'dados_modelo' => self::modelo1($request),            
            'imagens' => [
                'logo_empresa' => Arquivo::converter_imagem_base_64($request, 'logo_empresa'),
                'logo_cliente' => Arquivo::converter_imagem_base_64($request, 'logo_cliente'),                
                'imagem_area' => Arquivo::converter_imagem_base_64($request, 'imagem_area'),
            ]            
        ];        
        return view('formularios.modelos_de_relatorio.modelo1', $dados);
    }

    private static function modelo1($request){
        $total_perguntas_respondidas = Models\Resposta::where("formulario_id", $request->relatorio_formulario_id)->count();        
        $total_pilares = [
            'Pessoas' => self::total_perguntas_respondidas_pilar($request->relatorio_formulario_id, 'Pessoas'),
            'Tecnologia' => self::total_perguntas_respondidas_pilar($request->relatorio_formulario_id, 'Tecnologia'),
            'Processos' => self::total_perguntas_respondidas_pilar($request->relatorio_formulario_id, 'Processos'),
            'Informação' => self::total_perguntas_respondidas_pilar($request->relatorio_formulario_id, 'Informação'),
            'Gestão' => self::total_perguntas_respondidas_pilar($request->relatorio_formulario_id, 'Gestão'),
        ];
        $porcentagem_pilar = [
            'Pessoas' => percentual_puro($total_perguntas_respondidas, $total_pilares['Pessoas']),
            'Tecnologia' => percentual_puro($total_perguntas_respondidas, $total_pilares['Tecnologia']),
            'Processos' => percentual_puro($total_perguntas_respondidas, $total_pilares['Processos']),
            'Informação' => percentual_puro($total_perguntas_respondidas, $total_pilares['Informação']),
            'Gestão' => percentual_puro($total_perguntas_respondidas, $total_pilares['Gestão']),
        ];
        return [
            'porcentagem_pilar' => $porcentagem_pilar,
            'respostas' => self::todas_perguntas_respondidas($request->relatorio_formulario_id)
        ];
    }

    private static function total_perguntas_respondidas_pilar($formulario_id, $pilar){
        $tematica = Models\Tematica::where('nome', $pilar)->first();
        if(!$tematica){
            return 0;
        }
        return DB::table("respostas")->join("perguntas", "respostas.pergunta_id", "=", "perguntas.id")
        ->where('respostas.formulario_id', $formulario_id)->where('perguntas.tematica_id', $tematica->id)->count();        
    }

    private static function todas_perguntas_respondidas($formulario_id){
        $lista_pilares = Models\Tematica::pluck('id', 'nome')->toArray();
        $respostas = DB::table("respostas")
        ->join("perguntas", "respostas.pergunta_id", "=", "perguntas.id")
        ->where('respostas.formulario_id', $formulario_id)
        ->orderBy('respostas.data_cadastro', 'desc')        
        ->get();
        $lista = [];
        $posicao = 1;
        foreach($respostas as $resposta){
            $nome_pilar = self::escolher_imagem_pilar(array_search($resposta->tematica_id, $lista_pilares));
            $l = [
                'pilar' => $nome_pilar,
                'nc' => $posicao,
                'vulnerabilidade' => $resposta->nivel_adequacao,
                'nao_conformidade' => self::classificar_vulnerabilidade($resposta->nivel_adequacao),
                'topicos' => self::pegar_topicos_pergunta($resposta->pergunta_id),
                'criticidade' => self::classificar_risco($resposta->nivel_probabilidade,$resposta->nivel_impacto),
                'recomendacao' => $resposta->resposta,
                'prioridade' => self::classificar_prioridade($resposta->nivel_esforco, $resposta->nivel_valor),
                'risco' => $resposta->esta_em_risco_altissimo
            ];
            $lista[] = $l;
            $posicao++;            
        }        
        return $lista;
    }

    private static function escolher_imagem_pilar($pilar){
        $imagem = "";
        switch($pilar){
            case 'Pessoas': $imagem = asset('img/simbolo_pessoas_azul.png'); break;
            case 'Tecnologia': $imagem = asset('img/simbolo_tecnologia_azul.png'); break;
            case 'Processos': $imagem = asset('img/simbolo_processos_azul.png'); break;
            case 'Informação': $imagem = asset('img/simbolo_informacao_azul.png'); break;
            case 'Gestão': $imagem = asset('img/simbolo_gestao_azul.png'); break;
            default: $imagem = ""; break;
        }
        return $imagem;
    }

    private static function classificar_risco($probabilidade, $impacto){
        $produto = $probabilidade * $impacto;
        $classe = "";
        if($produto >= 1 && $produto <= 3){
            $classe = "verde-claro";
        }
        if($produto >= 4 && $produto <= 6){
            $classe = "verde-escuro";
        }
        if($produto >= 7 && $produto <= 12){
            $classe = "amarelo";
        }
        if($produto >= 13 && $produto <= 20){
            $classe = "laranja";
        }
        if($produto >= 20 && $produto <= 25){
            $classe = "vermelho-escuro";
        }
        return $classe;
    }

    private static function classificar_vulnerabilidade($vulnerabilidade){
        $nivel = "";
        switch($vulnerabilidade){
            case 1: $nivel = "Atende plenamento"; break;
            case 2: $nivel = "Atende após ajustes"; break;
            case 3: $nivel = "Atende após ajustes médios"; break;
            case 4: $nivel = "Não atende"; break;
            case 5: $nivel = "Não existe"; break;
            default: $nivel = ""; break;            
        }
        return $nivel;
    }

    private static function pegar_topicos_pergunta($pergunta_id){
        $topicos_pergunta = Models\PerguntaTopico::where("pergunta_id", $pergunta_id)->pluck('topico_id')->toArray();
        $topicos = Models\Topico::whereIn('id', $topicos_pergunta)->select('nome')->get();
        $lista = "";
        foreach($topicos as $topico){
            $lista .= " ".$topico->nome;
        }
        return $lista;
    }

    private static function classificar_prioridade($esforco, $valor){
        $produto = $esforco * $valor;
        $classe = "";
        if($produto >= getenv("VITE_LONGO_PRAZO_MINIMO") && $produto <= getenv("VITE_LONGO_PRAZO_MAXIMO")){
            $classe = "verde-claro";
        }
        if($produto >= getenv("VITE_MEDIO_PRAZO_MINIMO") && $produto <= getenv("VITE_MEDIO_PRAZO_MAXIMO")){
            $classe = "amarelo";
        }
        if($produto >= getenv("VITE_CURTO_PRAZO_MINIMO") && $produto <= getenv("VITE_CURTO_PRAZO_MAXIMO")){
            $classe = "vermelho-escuro";
        }
        return $classe;        
    }
}
