import { erro, sucesso } from '../app';

$(".gerar").click(function(){
    let formato = $(this).attr('formato');
    let inicio = $("#inicio").val();
    let fim = $("#fim").val();    
    let mensagem = '';
    if(inicio == ''){
        mensagem += "Data de inicío é obrigatório!";        
    }
    if(fim == ''){
        mensagem += "Data de fim é obrigatório!"        
    }
    if(mensagem != ''){
        erro(mensagem);
        return;
    }
    window.open(`/auditoria/relatorio/${formato}/${inicio}/${fim}`, '_blank');    
});