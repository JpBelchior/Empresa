import { abrir_modal, erro, habilitar_botao, mostrar_informacoes_modal } from '../app';

$("#btn_modal_trocar_empresa").click(function(){   
    abrir_modal('modal_trocar_empresa', false);
    axios.get('empresas/lista')
    .then(response => {
        let empresas = response.data;
        $("#trocar_empresa_lista").empty();
        for(let i in empresas){
            let o = `<option value="${empresas[i].id}">${empresas[i].razao_social}</option>`;
            $("#trocar_empresa_lista").append(o);
        } 
        mostrar_informacoes_modal('modal_trocar_empresa');
    })
    .catch(error => {
        erro(error);
    });    
});

$("#btn_trocar_empresa").click(function(){
    habilitar_botao('btn_trocar_empresa', false);
    axios.post('empresas/trocar_empresa', { empresa_id: $("#trocar_empresa_lista").val() })
    .then(response => {
        location.reload();
    })
    .catch(error => {
        erro(error);
        habilitar_botao('btn_trocar_empresa', true);  
    });
});