<x-modal id="modal_perguntas_respondidas" label="Perguntas Respondidas">
    <a target="_blank" href="/formularios/relatorio/{{ $formulario->id }}/pdf" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
        <i class="fas fa-file-pdf"></i>        
    </a>
    <a target="_blank" href="/formularios/relatorio/{{ $formulario->id }}/excel" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
        <i class="fas fa-file-excel"></i>        
    </a>
        
    <br>
    <br>
    <br>
    <h1>Respostas em ESPERA <span id="perguntas_em_espera_qtd"></span></h1>
    <div class="mt-4 relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">            
            <tbody id="perguntas_respondidas_em_espera">                
                
            </tbody>
        </table>
    </div>
    <h1>Respostas cadastradas</h1>
    <div class="mt-4 relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">            
            <tbody id="perguntas_respondidas">                
                
            </tbody>
        </table>
    </div>
</x-modal>