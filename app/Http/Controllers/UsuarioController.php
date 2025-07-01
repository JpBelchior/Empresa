<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use PhpParser\Node\Stmt\Foreach_;

class UsuarioController extends Controller
{
    use AuthorizesRequests;

    public function __construct(){
        session(["primeira_sessao" => "Usuários"]);
    }
    
    public function index(){                
        session(["segunda_sessao" => "Visão Geral"]);
        return view('usuarios.index');
    }

    public function lista(){
        return Models\User::with(['empresa'])->where('atribuicao', '!=', 'administrador')->orderBy('nome', 'asc')->get();
    }

    public function adicionar(Request $request){        
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:255',
            'cpf_cnpj' => 'required',
            'email' => 'required|max:255',
            'whatsapp' => 'required|max:255',            
            'empresa_id' => 'required',            
            'atribuicao' => 'required'
        ]);
        if($validator->fails()){    
            return response()->json($validator->errors(), 422);
        }        
        if(!validar_cpf_cnpj($request->cpf_cnpj)){
            return response()->json('CPF/CNPJ é inválido!', 422);
        }
        $usuario_com_mesmo_cpf_cnpj = Models\User::where('cpf_cnpj', $request->cpf_cnpj)->first();
        if($usuario_com_mesmo_cpf_cnpj){
            return response()->json("Usuário $usuario_com_mesmo_cpf_cnpj->nome possui este CPF/CNPJ!", 422);
        }
        $usuario_com_mesmo_email = Models\User::where('email', $request->email)->first();
        if($usuario_com_mesmo_email){
            return response()->json("Usuário $usuario_com_mesmo_email->nome possui este email!", 422);
        }        
        Models\Auditoria::registrar_atividade('Cadastro de Usuário');
        Models\User::adicionar($request);
        return response()->json('Usuário cadastrado com sucesso!', 200);
    }

    public function editar($usuario_id, Request $request){        
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:255',
            'cpf_cnpj' => 'required',
            'email' => 'required|max:255',
            'whatsapp' => 'required|max:255',            
            'empresa_id' => 'required',            
            'atribuicao' => 'required'
        ]);        
        if($validator->fails()){    
            return response()->json($validator->errors(), 422);
        }        
        if(!validar_cpf_cnpj($request->cpf_cnpj)){
            return response()->json('CPF/CNPJ é inválido!', 422);
        }
        $usuario_com_mesmo_cpf_cnpj = Models\User::where('cpf_cnpj', $request->cpf_cnpj)->where('id', '!=', $usuario_id)->first();
        if($usuario_com_mesmo_cpf_cnpj){
            return response()->json("Usuário $usuario_com_mesmo_cpf_cnpj->nome possui este CPF/CNPJ!", 422);
        }
        $usuario_com_mesmo_email = Models\User::where('email', $request->email)->where('id', '!=', $usuario_id)->first();
        if($usuario_com_mesmo_email){
            return response()->json("Usuário $usuario_com_mesmo_email->nome possui este email!", 422);
        }
        if($request->senha){
            if(mb_strlen($request->senha) < 6){
                return response()->json("A senha de usuário deve conter no mínimo 6 caracteres!", 422);
            }
            Models\User::alterar_senha_usuario($usuario_id, $request->senha);
        }
        Models\Auditoria::registrar_atividade('Edição de Usuário');
        Models\User::editar($usuario_id, $request);
        return response()->json('Usuário editado com sucesso!', 200);
    }

    public function pesquisar($parametro, $valor){
        if($parametro == 'ativo'){
            $ativo = $valor == 'true' ? true : false;
            return Models\User::where('ativo', $ativo)->orderBy('nome', 'asc')->get();    
        }
        return Models\User::where($parametro, "like", "%$valor%")->orderBy('nome', 'asc')->get();
    }

    public function detalhes($usuario_id){
        return Models\User::find($usuario_id);
    }

    public function estatisticas(){
        $atribuicao = Auth::user()->atribuicao;        
        $dataAtual = new \DateTime();        
        // Mês e ano atual
        $mes_atual = $dataAtual->format('m');
        $ano_atual = $dataAtual->format('Y');
        // Mês e ano anterior
        $dataAnterior = (clone $dataAtual)->sub(new \DateInterval('P1M'));        
        $mes_anterior = $dataAnterior->format('m');
        $ano_anterior = $dataAnterior->format('Y');
        //PROJETOS
        $quantidade_projetos_criados_mes_vigente = Models\Projeto::whereYear('data_inicio', $ano_atual)
        ->whereMonth('data_inicio', $mes_atual)
        ->where('empresa_id', session('empresa_id'))
        ->count();
        $quantidade_projetos_criados_mes_anterior = Models\Projeto::whereYear('data_inicio', $ano_anterior)
        ->whereMonth('data_inicio', $mes_anterior)
        ->where('empresa_id', session('empresa_id'))
        ->count();
        //VULNERABILIDADES
        $quantidade_vulnerabilidades_mes_vigente = Models\Projeto::whereYear('data_inicio', $ano_atual)
        ->whereMonth('data_inicio', $mes_atual)
        ->where('empresa_id', session('empresa_id'))
        ->sum('total_vulnerabilidades');
        $quantidade_vulnerabilidades_mes_anterior = Models\Projeto::whereYear('data_inicio', $ano_anterior)
        ->whereMonth('data_inicio', $mes_anterior)
        ->where('empresa_id', session('empresa_id'))
        ->sum('total_vulnerabilidades');
        //RISCOS ALTÍSSIMOS
        $quantidade_riscos_mes_vigente = Models\Projeto::whereYear('data_inicio', $ano_atual)
        ->whereMonth('data_inicio', $mes_atual)
        ->where('empresa_id', session('empresa_id'))
        ->sum('total_riscos_altissimos');
        $quantidade_riscos_mes_anterior = Models\Projeto::whereYear('data_inicio', $ano_anterior)
        ->whereMonth('data_inicio', $mes_anterior)
        ->where('empresa_id', session('empresa_id'))
        ->sum('total_riscos_altissimos');
        //RECOMENDAÇÕES
        $quantidade_recomendacoes_mes_vigente = Models\Projeto::whereYear('data_inicio', $ano_atual)
        ->whereMonth('data_inicio', $mes_atual)
        ->where('empresa_id', session('empresa_id'))
        ->sum('total_recomendacoes');
        $quantidade_recomendacoes_mes_anterior = Models\Projeto::whereYear('data_inicio', $ano_anterior)
        ->whereMonth('data_inicio', $mes_anterior)
        ->where('empresa_id', session('empresa_id'))
        ->sum('total_recomendacoes');
        //DADOS DO MOMENTO VIGENTE
        $datas_do_mes_vigente = datasDoMesVigente();        
        $dias_numericos_mes_vigente = diasNumericosDoMesVigente();                
        //GRÁFICO DE PROJETOS        
        $quantidade_projetos_criados = [];
        foreach($datas_do_mes_vigente as $data){
            $quantidade_projetos_criados[] = Models\Projeto::where('empresa_id', session('empresa_id'))->where('data_inicio', $data)->count();
        }
        $dados_grafico_projetos = [
            'dias' => $dias_numericos_mes_vigente,
            'quantidade' => $quantidade_projetos_criados
        ];
        //GRAFICO DE RISCO ALTISSIMO
        $quantidade_riscos_criados = [];
        foreach($datas_do_mes_vigente as $data){
            $quantidade_riscos_criados[] = DB::table('respostas')
            ->join("formularios", "respostas.formulario_id", "=", "formularios.id")
            ->where('formularios.empresa_id', session('empresa_id'))
            ->where('esta_em_risco_altissimo', true)
            ->whereDate('respostas.data_cadastro', $data)
            ->count();
        }
        $dados_grafico_riscos = [
            'dias' => $dias_numericos_mes_vigente,
            'quantidade' => $quantidade_riscos_criados
        ];
        //GRÁFICO PILARES
        $pilares = [];
        $todos_pilares = Models\Tematica::get();
        $estatisticas_pilares = [];
        foreach($todos_pilares as $pilar){
            $pilares[] = $pilar->nome;
            $estatisticas_pilares[] = DB::table('respostas')->join('perguntas', "respostas.pergunta_id", "=", "perguntas.id")
            ->whereMonth('respostas.data_cadastro', $mes_atual)
            ->whereYear('respostas.data_cadastro', $ano_atual)
            ->where("perguntas.tematica_id", $pilar->id)
            ->count();
        }
        $dados_grafico_pilares = [
            'pilares' => $pilares,
            'estatisticas' => $estatisticas_pilares
        ];
        //GRÁFICO DE TÓPICOS
        $topicos = [];                
        $estatisticas_topicos = [];
            //PEGAR TODAS AS RESPOSTAS DO MES
        $respostas_do_mes = DB::table('respostas')
        ->join('perguntas', "respostas.pergunta_id", "=", "perguntas.id")
        ->whereMonth('respostas.data_cadastro', $mes_atual)
        ->whereYear('respostas.data_cadastro', $ano_atual)  
        ->where('esta_em_risco_altissimo', true)          
        ->select("perguntas.id as pergunta_id")                       
        ->get();
            //VER O TOPICO DE CADA RESPOSTA E CONTAR QUANTAS RESPOSTAS FORAM RESPONDIDAS EM CADA UMA
        foreach($respostas_do_mes as $resposta){
            $topicos_da_resposta = DB::table('pergunta_topico')
            ->join("topicos", "pergunta_topico.topico_id", "=", "topicos.id")
            ->where("pergunta_topico.pergunta_id", $resposta->pergunta_id)
            ->pluck("nome")
            ->toArray();
            foreach($topicos_da_resposta as $topico){
                if(isset($estatisticas_topicos[$topico])){
                    $estatisticas_topicos[$topico]++;
                }else{
                    $estatisticas_topicos[$topico] = 1;
                }
            }            
        }
        arsort($estatisticas_topicos);//ORDENO DO MAIOR PARA O MENOR
        $estatisticas_topicos = array_slice($estatisticas_topicos, 0, 5, true); //PEGO OS CINCO PRIMEIROS
        $topicos = array_keys($estatisticas_topicos);
        $quantidade_topicos = array_values($estatisticas_topicos);        
        $dados_grafico_topicos = [
            'topicos' => $topicos,
            'quantidade' => $quantidade_topicos
        ];
        //5 ULTIMOS PROJETOS
        $lista_projetos = Models\Projeto::with(['usuario_criador'])
        ->where('empresa_id', session('empresa_id'))
        ->orderBy('data_inicio', 'desc')        
        ->limit(5)
        ->get()
        ->map(function ($projeto) {
            return [
                'nome' => $projeto->nome,
                'data_inicio' => $projeto->data_inicio,
                'data_conclusao' => $projeto->data_conclusao,
                'status' => $projeto->status,
                'criador' => $projeto->usuario_criador?->nome,
            ];
        });
        $dados = [
            'qtd_projetos_mes' => $quantidade_projetos_criados_mes_vigente,
            'percentual_projetos' => percentual($quantidade_projetos_criados_mes_anterior, $quantidade_projetos_criados_mes_vigente),
            'qtd_vulnerabilidades_mes' => $quantidade_vulnerabilidades_mes_vigente,
            'percentual_vulnerabilidades' => percentual($quantidade_vulnerabilidades_mes_anterior, $quantidade_vulnerabilidades_mes_vigente),
            'qtd_riscos_mes' => $quantidade_riscos_mes_vigente,
            'percentual_riscos' => percentual($quantidade_riscos_mes_anterior, $quantidade_riscos_mes_vigente),
            'qtd_recomendacoes_mes' => $quantidade_recomendacoes_mes_vigente,
            'percentual_recomendacoes' => percentual($quantidade_recomendacoes_mes_anterior, $quantidade_recomendacoes_mes_vigente),
            'lista_projetos' => $lista_projetos,
            'grafico_projetos' => $dados_grafico_projetos,
            'grafico_riscos' => $dados_grafico_riscos,
            'grafico_pilares' => $dados_grafico_pilares,
            'grafico_topicos' => $dados_grafico_topicos
        ];
        return response()->json($dados,200);
    }
}
