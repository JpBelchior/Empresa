import { erro, formatar_data } from '../app';

export function lista_projetos() {
    $("#projetos").empty();
    axios('projetos/lista')
        .then(response => {
            let projetos = response.data;                  
            for(let i in projetos){            
                let tipos_empreendimentos = projetos[i].tipos_empreendimentos;                                
                let tp = "";
                for(let j in tipos_empreendimentos){
                    let t = `<span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-yellow-900 dark:text-yellow-300">${tipos_empreendimentos[j].tipo_empreendimento.nome}</span>`;
                    tp += t;
                }                
                let funcionarios = projetos[i].usuarios;
                let f = "";
                for(let x in funcionarios){
                    let func = `<span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-yellow-900 dark:text-yellow-300">${funcionarios[x].usuario.nome}</span>`;
                    f += func;
                }
                let botao_editar = "";
                if(atribuicao == 'administrador' || atribuicao == 'gerente' || atribuicao == 'rh'){
                    botao_editar = `<button projeto="${projetos[i].id}" type="button" class=" px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <i class="fas fa-edit"></i>                                    
                                    </button>`;
                }
                botao_editar = "";
                let projeto = `
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">                                            
                            <td class="px-6 py-4">
                                ${projetos[i].nome}                                
                            </td>
                            <td class="px-6 py-4 grid place-items-center">                                
                                ${formatar_data(projetos[i].data_projeto, false)}                                                                
                            </td>
                            <td class="px-6 py-4">
                                ${tp}                                
                            </td>
                            <td class="px-6 py-4">
                                ${f}
                            </td>
                            <td class="px-6 py-4">
                                ${botao_editar}                                                            
                            </td>
                        </tr>`;
                $("#projetos").append(projeto);
            }
        })
        .catch(error => {
            erro(error);
        })
        .finally(() => {})
}

export function pesquisar_projetos(parametro, valor) {
    return new Promise((resolve, reject) => {
    axios.get('projetos/pesquisar/' + parametro + '/' + valor)
        .then(response => {
            resolve(response.data);
        })
        .catch(error => {
            reject(error);
        });
    });
}