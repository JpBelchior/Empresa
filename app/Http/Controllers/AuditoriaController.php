<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AuditoriaController extends Controller
{
    use AuthorizesRequests;
    
    public function index(){                
        return view('auditoria.index');
    }

    public function relatorio($formato, $inicio, $fim){
        $usuarios = Models\User::where('empresa_id', session('empresa_id'))->pluck('id')->toArray();
        $registros = DB::table('auditorias')
        ->join("users", 'auditorias.usuario_id', "=", "users.id")
        ->whereIn('auditorias.usuario_id', $usuarios)
        ->where('auditorias.data_cadastro', ">=", $inicio)
        ->where('auditorias.data_cadastro', "<=", $fim)
        ->orderBy('auditorias.data_cadastro', 'desc')
        ->get();        
        $dados = [
            'registros' => $registros
        ];        
        if($formato == 'pdf'){
            return view('auditoria.pdf', $dados);
        }
        if($formato == 'excel'){
            $spreadsheet = new Spreadsheet();
            $activeWorksheet = $spreadsheet->getActiveSheet();            
            $activeWorksheet->setTitle("Auditoria");            
            $activeWorksheet->getColumnDimension('A')->setAutoSize(true);
            $activeWorksheet->getColumnDimension('B')->setAutoSize(true);
            $activeWorksheet->getColumnDimension('C')->setAutoSize(true);
            $activeWorksheet->getColumnDimension('D')->setAutoSize(true);                    
            $activeWorksheet->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('B')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('D')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);                    
            $activeWorksheet->setCellValue('A1', 'USUÁRIO');
            $activeWorksheet->setCellValue('B1', 'NOME DA AÇÃO');
            $activeWorksheet->setCellValue('C1', 'IP');
            $activeWorksheet->setCellValue('D1', 'DATA DA AÇÃO');            
            $quantidade = count($registros);
            if($quantidade > 0){
                for($i = 0; $i < $quantidade; $i++){
                    $celula = $i + 2;
                    $activeWorksheet->setCellValue('A'.$celula, $registros[$i]->nome);
                    $activeWorksheet->setCellValue('B'.$celula, $registros[$i]->nome_acao);
                    $activeWorksheet->setCellValue('C'.$celula, $registros[$i]->ip);
                    $activeWorksheet->setCellValue('D'.$celula, formatar_data($registros[$i]->data_cadastro));                    
                }
            }
            $writer = new Xlsx($spreadsheet);
            $filename = 'auditoria.xlsx';
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header('Cache-Control: max-age=0');
            $writer->save('php://output');
            exit;
        }
    }
}
