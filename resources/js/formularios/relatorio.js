import { abrir_modal } from "../app";


$("#btn_modal_relatorio").click(function(){
    let formulario_id = $("#formulario_id").val();
    $("input[name='relatorio_formulario_id']").val(formulario_id);    
    abrir_modal('modal_relatorio');
});