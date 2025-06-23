import { erro } from '../app';

export function lista_clientes() {
    $("#clientes").empty();
    axios('clientes/lista')
        .then(response => {
            let clientes = response.data;
            for (let i in clientes) {
                let ativo = '<span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300">Ativo</span>';
                let inativo = '<span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-red-900 dark:text-red-300">Inativo</span>';
                let status = clientes[i].ativo ? ativo : inativo;
                let area = `
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">                
                            <td class="px-6 py-4">
                                ${status}
                            </td>
                            <td class="px-6 py-4">
                                ${clientes[i].nome}                                
                            </td>                            
                            <td class="px-6 py-4">
                                <button cliente="${clientes[i].id}" type="button" class="editar px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <i class="fas fa-edit"></i>                                    
                                </button>
                            </td>
                        </tr>`;
                $("#clientes").append(area);
            }
        })
        .catch(error => {
            erro(error);
        })
        .finally(() => {})
}

export function pesquisar_clientes(parametro, valor) {
    return new Promise((resolve, reject) => {
    axios.get('clientes/pesquisar/'+parametro+"/"+valor)
        .then(response => {
            resolve(response.data);
        })
        .catch(error => {
            reject(error);
        });
    });
}