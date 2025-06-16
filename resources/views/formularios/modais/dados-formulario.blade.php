<x-modal id="modal_dados_formulario" label="" tamanho="grande">
    <p id="titulo_pergunta" class="titulo">PERGUNTA</p>
    <div class="dados-formulario-sessao">
        <p class="classe-opcao">Nível de adequação identificado na inspeção</p>
        <ol class="opcoes mt-4 flex items-center">
            <li class="relative w-full mb-6">
                <div class="mb-3">
                    <h3 class="font-medium text-gray-900 dark:text-white">Atende plenamente</h3>
                </div>
                <div class="flex items-center">
                    <div class="z-10 flex items-center justify-center bg-blue-600 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                        <input type="radio" value="1" name="adequacao" class="text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    </div>
                    <div class="flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                </div>
                <div class="mt-3">
                    <h3 class="font-medium text-gray-900 dark:text-white">1</h3>
                </div>
            </li>
            <li class="relative w-full mb-6">
                <div class="mb-3">
                    <h3 class="font-medium text-gray-900 dark:text-white">Atende após ajustes</h3>
                </div>
                <div class="flex items-center">
                    <div class="z-10 flex items-center justify-center bg-blue-600 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                        <input type="radio" value="2" name="adequacao" class="text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    </div>
                    <div class="flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                </div>
                <div class="mt-3">
                    <h3 class="font-medium text-gray-900 dark:text-white">2</h3>
                </div>
            </li>
            <li class="relative w-full mb-6">
                <div class="mb-3">
                    <h3 class="font-medium text-gray-900 dark:text-white">Atende após ajustes médios</h3>
                </div>
                <div class="flex items-center">
                    <div class="z-10 flex items-center justify-center bg-blue-600 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                        <input type="radio" value="3" name="adequacao" class="text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    </div>
                    <div class="flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                </div>
                <div class="mt-3">
                    <h3 class="font-medium text-gray-900 dark:text-white">3</h3>
                </div>
            </li>
            <li class="relative w-full mb-6">
                <div class="mb-3">
                    <h3 class="font-medium text-gray-900 dark:text-white">Não atende</h3>
                </div>
                <div class="flex items-center">
                    <div class="z-10 flex items-center justify-center bg-blue-600 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                        <input type="radio" value="4" name="adequacao" class="text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    </div>
                    <div class="flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                </div>
                <div class="mt-3">
                    <h3 class="font-medium text-gray-900 dark:text-white">4</h3>
                </div>
            </li>
            <li class="relative w-full mb-6">
                <div class="mb-3">
                    <h3 class="font-medium text-gray-900 dark:text-white">Não existe</h3>
                </div>
                <div class="flex items-center">
                    <div class="z-10 flex items-center justify-center bg-blue-600 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                        <input type="radio" value="5" name="adequacao" class="text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    </div>
                    <div class="flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                </div>
                <div class="mt-3">
                    <h3 class="font-medium text-gray-900 dark:text-white">5</h3>
                </div>
            </li>
        </ol>
        <div class="flex justify-center">
            <span id="vulneravel" class="hidden bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-red-900 dark:text-red-300">Vulnerável</span>
            <span id="adequado" class="hidden bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300">Adequado</span>
        </div>
    </div>    
    <h2 class="text-center">Classifique o risco utilizando a matriz Probabilidade X Impacto</h2>
    <div class="dados-formulario-sessao">
        <div>
            <p class="classe-opcao">Probabilidade</p>
            <ol class="opcoes mt-4 flex items-center">
                <li class="relative w-full mb-6">
                    <div class="flex items-center">
                        <div class="z-10 flex items-center justify-center bg-blue-600 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <input type="radio" value="1" name="probabilidade" class="text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div class="flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3">
                        <h3 class="font-medium text-gray-900 dark:text-white">1</h3>
                    </div>
                </li>
                <li class="relative w-full mb-6">
                    <div class="flex items-center">
                        <div class="z-10 flex items-center justify-center bg-blue-600 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <input type="radio" value="2" name="probabilidade" class="text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div class="flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3">
                        <h3 class="font-medium text-gray-900 dark:text-white">2</h3>
                    </div>
                </li>
                <li class="relative w-full mb-6">
                    <div class="flex items-center">
                        <div class="z-10 flex items-center justify-center bg-blue-600 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <input type="radio" value="3" name="probabilidade" class="text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div class="flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3">
                        <h3 class="font-medium text-gray-900 dark:text-white">3</h3>
                    </div>
                </li>
                <li class="relative w-full mb-6">
                    <div class="flex items-center">
                        <div class="z-10 flex items-center justify-center bg-blue-600 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <input type="radio" value="4" name="probabilidade" class="text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div class="flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3">
                        <h3 class="font-medium text-gray-900 dark:text-white">4</h3>
                    </div>
                </li>
                <li class="relative w-full mb-6">
                    <div class="flex items-center">
                        <div class="z-10 flex items-center justify-center bg-blue-600 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <input type="radio" value="5" name="probabilidade" class="text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div class="flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3">
                        <h3 class="font-medium text-gray-900 dark:text-white">5</h3>
                    </div>
                </li>
            </ol>
        </div>
        <div>
            <p class="classe-opcao">Impacto</p>
            <ol class="opcoes mt-4 flex items-center">
                <li class="relative w-full mb-6">
                    <div class="flex items-center">
                        <div class="z-10 flex items-center justify-center bg-blue-600 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <input type="radio" value="1" name="impacto" class="text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div class="flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3">
                        <h3 class="font-medium text-gray-900 dark:text-white">1</h3>
                    </div>
                </li>
                <li class="relative w-full mb-6">
                    <div class="flex items-center">
                        <div class="z-10 flex items-center justify-center bg-blue-600 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <input type="radio" value="2" name="impacto" class="text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div class="flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3">
                        <h3 class="font-medium text-gray-900 dark:text-white">2</h3>
                    </div>
                </li>
                <li class="relative w-full mb-6">
                    <div class="flex items-center">
                        <div class="z-10 flex items-center justify-center bg-blue-600 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <input type="radio" value="3" name="impacto" class="text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div class="flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3">
                        <h3 class="font-medium text-gray-900 dark:text-white">3</h3>
                    </div>
                </li>
                <li class="relative w-full mb-6">
                    <div class="flex items-center">
                        <div class="z-10 flex items-center justify-center bg-blue-600 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <input type="radio" value="4" name="impacto" class="text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div class="flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3">
                        <h3 class="font-medium text-gray-900 dark:text-white">4</h3>
                    </div>
                </li>
                <li class="relative w-full mb-6">
                    <div class="flex items-center">
                        <div class="z-10 flex items-center justify-center bg-blue-600 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <input type="radio" value="5" name="impacto" class="text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div class="flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3">
                        <h3 class="font-medium text-gray-900 dark:text-white">5</h3>
                    </div>
                </li>
            </ol>
        </div>
        <div class="flex justify-center">
            <span id="risco_altissimo" class="hidden bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-red-900 dark:text-red-300">Risco altíssimo</span>            
        </div>
    </div>
    <h2 class="text-center">Avalie a iniciativa na matriz Esforço X Valor, considerando custo, tempo e complexidade versus benefício</h2>
    <div class="dados-formulario-sessao">
        <div>
            <p class="classe-opcao">Esforço</p>
            <ol class="opcoes mt-4 flex items-center">
                <li class="relative w-full mb-6">
                    <div class="flex items-center">
                        <div class="z-10 flex items-center justify-center bg-blue-600 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <input type="radio" value="1" name="esforco" class="text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div class="flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3">
                        <h3 class="font-medium text-gray-900 dark:text-white">1</h3>
                    </div>
                </li>
                <li class="relative w-full mb-6">
                    <div class="flex items-center">
                        <div class="z-10 flex items-center justify-center bg-blue-600 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <input type="radio" value="2" name="esforco" class="text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div class="flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3">
                        <h3 class="font-medium text-gray-900 dark:text-white">2</h3>
                    </div>
                </li>
                <li class="relative w-full mb-6">
                    <div class="flex items-center">
                        <div class="z-10 flex items-center justify-center bg-blue-600 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <input type="radio" value="3" name="esforco" class="text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div class="flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3">
                        <h3 class="font-medium text-gray-900 dark:text-white">3</h3>
                    </div>
                </li>
                <li class="relative w-full mb-6">
                    <div class="flex items-center">
                        <div class="z-10 flex items-center justify-center bg-blue-600 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <input type="radio" value="4" name="esforco" class="text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div class="flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3">
                        <h3 class="font-medium text-gray-900 dark:text-white">4</h3>
                    </div>
                </li>
                <li class="relative w-full mb-6">
                    <div class="flex items-center">
                        <div class="z-10 flex items-center justify-center bg-blue-600 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <input type="radio" value="5" name="esforco" class="text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div class="flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3">
                        <h3 class="font-medium text-gray-900 dark:text-white">5</h3>
                    </div>
                </li>
            </ol>
        </div>
        <div>
            <p class="classe-opcao">Valor</p>
            <ol class="opcoes mt-4 flex items-center">
                <li class="relative w-full mb-6">
                    <div class="flex items-center">
                        <div class="z-10 flex items-center justify-center bg-blue-600 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <input type="radio" value="1" name="valor" class="text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div class="flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3">
                        <h3 class="font-medium text-gray-900 dark:text-white">1</h3>
                    </div>
                </li>
                <li class="relative w-full mb-6">
                    <div class="flex items-center">
                        <div class="z-10 flex items-center justify-center bg-blue-600 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <input type="radio" value="2" name="valor" class="text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div class="flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3">
                        <h3 class="font-medium text-gray-900 dark:text-white">2</h3>
                    </div>
                </li>
                <li class="relative w-full mb-6">
                    <div class="flex items-center">
                        <div class="z-10 flex items-center justify-center bg-blue-600 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <input type="radio" value="3" name="valor" class="text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div class="flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3">
                        <h3 class="font-medium text-gray-900 dark:text-white">3</h3>
                    </div>
                </li>
                <li class="relative w-full mb-6">
                    <div class="flex items-center">
                        <div class="z-10 flex items-center justify-center bg-blue-600 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <input type="radio" value="4" name="valor" class="text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div class="flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3">
                        <h3 class="font-medium text-gray-900 dark:text-white">4</h3>
                    </div>
                </li>
                <li class="relative w-full mb-6">
                    <div class="flex items-center">
                        <div class="z-10 flex items-center justify-center bg-blue-600 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <input type="radio" value="5" name="valor" class="text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div class="flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3">
                        <h3 class="font-medium text-gray-900 dark:text-white">5</h3>
                    </div>
                </li>
            </ol>
        </div>
        <div class="flex justify-center">
            <span id="curto_prazo" class="hidden bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-red-900 dark:text-red-300">Curto prazo</span>            
            <span id="medio_prazo" class="hidden bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-yellow-900 dark:text-yellow-300">Médio prazo</span>
            <span id="longo_prazo" class="hidden bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300">Longo prazo</span>
        </div>
    </div>    
    <h2 class="text-center">Indique as recomendações necessárias para mitigar os riscos e vulnerabilidades identificados</h2>
    <x-textarea id="resposta"></x-textarea>
    <x-input label="Foto" id="foto" type="file" accept="image/png, image/jpeg, image/jpg"></x-input>
    <x-botao id="btn_salvar_respostas" label="Salvar" class="w-full" cor="verde"></x-botao>
</x-modal>
@vite('resources/js/formularios/dados-formulario.js')