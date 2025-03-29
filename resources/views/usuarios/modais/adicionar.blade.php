<x-modal id="modal_adicionar_usuario" label="Adicionar Usuário">
    <x-input id="adicionar_usuario_nome" label="Nome" maxlength="255" obrigatorio="sim"></x-input>
    <x-input id="adicionar_usuario_cpf_cnpj" class="cpf_cnpj" label="CPF/CNPJ" obrigatorio="sim"></x-input>
    <x-input id="adicionar_usuario_email" label="Email" maxlength="255" obrigatorio="sim"></x-input>
    <x-input id="adicionar_usuario_whatsapp" class="celular" label="Whatsapp" maxlength="255" obrigatorio="sim"></x-input>    
    <x-select id="adicionar_usuario_empresa_id" label="Empresa" obrigatorio="sim"></x-select>
    <x-select id="adicionar_usuario_atribuicao" label="Atribuição" obrigatorio="sim">
        <option value="rh">RH</option>
        <option value="gerente">Gerente</option>
        <option value="agente">Agente</option>
    </x-select>
    <div class="flex justify-center">
        <x-botao id="btn_adicionar_usuario" label="Confirmar"></x-botao>
    </div>
</x-modal>
@vite('resources/js/usuarios/adicionar.js')