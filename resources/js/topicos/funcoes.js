import { erro } from '../app';

export function lista_topicos() {
    $("#topicos").empty();
    axios('topicos/lista')
        .then(response => {
            let topicos = response.data;
            for (let i in topicos) {
                let ativo = '<span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">Ativo</span>';
                let inativo = '<span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">Inativo</span>';
                let status = topicos[i].ativo ? ativo : inativo;
                let topico = `
                        <tr class="bg-white border-b border-gray-200">                
                            <td class="px-6 py-4">
                                ${status}
                            </td>
                            <td class="px-6 py-4">
                                ${topicos[i].nome}                                
                            </td>                            
                            <td class="px-6 py-4">
                                <button topico="${topicos[i].id}" type="button" class="editar px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 ">
                                    <i class="fas fa-edit"></i>                                    
                                </button>
                            </td>
                        </tr>`;
                $("#topicos").append(topico);
            }
        })
        .catch(error => {
            erro(error);
        })
        .finally(() => {})
}

export function pesquisar_topicos(parametro, valor) {
    return new Promise((resolve, reject) => {
    axios.get('topicos/pesquisar/'+parametro+"/"+valor)
        .then(response => {
            resolve(response.data);
        })
        .catch(error => {
            reject(error);
        });
    });
}