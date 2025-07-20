import { erro } from '../app';

export function lista_usuarios() {
    $("#usuarios").empty();
    axios('usuarios/lista')
        .then(response => {
            let usuarios = response.data;                        
            for (let i in usuarios) {                
                let ativo = '<span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm ">Ativo</span>';
                let inativo = '<span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm ">Inativo</span>';
                let status = usuarios[i].ativo ? ativo : inativo;
                let usuario = `
                        <tr class="bg-white border-b border-gray-200">                
                            <td class="px-6 py-4">
                                ${status}
                            </td>
                            <td class="px-6 py-4">
                                ${usuarios[i].nome}                                
                            </td>
                            <td class="px-6 py-4">
                                ${usuarios[i].cpf_cnpj}                                
                            </td>                            
                            <td class="px-6 py-4">
                                ${usuarios[i].atribuicao}                                
                            </td>                            
                            <td class="px-6 py-4">
                                ${usuarios[i].empresa.razao_social}                                
                            </td>
                            <td class="px-6 py-4">
                                <button usuario="${usuarios[i].id}" type="button" class="editar px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                    <i class="fas fa-edit"></i>                                    
                                </button>
                            </td>
                        </tr>`;
                $("#usuarios").append(usuario);
            }
        })
        .catch(error => {
            erro(error);
        })
        .finally(() => {})
}

export function pesquisar_usuario(parametro, valor) {
    return new Promise((resolve, reject) => {
    axios.get('usuarios/pesquisar/'+parametro+"/"+valor)
        .then(response => {
            resolve(response.data);
        })
        .catch(error => {
            reject(error);
        });
    });
}