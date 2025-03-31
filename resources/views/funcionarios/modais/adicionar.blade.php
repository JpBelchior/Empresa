<x-modal id="modal_adicionar_usuario" label="Adicionar Funcionário">
    <x-input id="adicionar_usuario_nome" label="Nome" maxlength="255" obrigatorio="sim"></x-input>
    <x-input id="adicionar_usuario_cpf_cnpj" class="cpf_cnpj" label="CPF/CNPJ" obrigatorio="sim"></x-input>
    <x-input id="adicionar_usuario_email" label="Email" maxlength="255" obrigatorio="sim"></x-input>
    <x-input id="adicionar_usuario_whatsapp" class="celular" label="Whatsapp" maxlength="255" obrigatorio="sim"></x-input>    
    <x-select id="adicionar_usuario_atribuicao" label="Atribuição" obrigatorio="sim">        
        @if($atribuicao == 'rh')
        <option value="gerente">Gerente</option>
        @endif
        <option value="agente">Agente</option>
    </x-select>
    <div class="flex justify-center">
        <x-botao id="btn_adicionar_usuario" label="Confirmar"></x-botao>
    </div>
</x-modal>
@vite('resources/js/funcionarios/adicionar.js')