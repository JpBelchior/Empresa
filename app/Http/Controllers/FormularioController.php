<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;
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
        ->orderBy('nome', 'asc')->get();
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
}
