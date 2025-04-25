<x-modal id="modal_editar_usuario" label="Editar Usuário">
    <x-input id="editar_usuario_id" type="hidden"></x-input>
    <x-input id="editar_usuario_nome" label="Nome" maxlength="255" obrigatorio="sim"></x-input>
    @if($atribuicao == 'rh')
    <x-input id="editar_usuario_cpf_cnpj" class="cpf_cnpj" label="CPF/CNPJ" obrigatorio="sim"></x-input>
    @else
    <input id="editar_usuario_cpf_cnpj" type="hidden">
    @endif
    <x-input id="editar_usuario_email" label="Email" maxlength="255" obrigatorio="sim"></x-input>
    <x-input id="editar_usuario_whatsapp" class="celular" label="Whatsapp" maxlength="255" obrigatorio="sim"></x-input>        
    <x-checkbox id="editar_usuario_ativo" type="checkbox" label="Ativo"></x-checkbox>
    <x-select id="editar_usuario_atribuicao" label="Atribuição" obrigatorio="sim">        
        @if($atribuicao == 'rh' || $atribuicao == 'administrador')
        <option value="gerente">Gerente</option>
        @endif
        <option value="agente">Agente</option>
    </x-select>
    <x-input id="editar_usuario_senha" type="password" label="Senha" maxlength="255"></x-input>
    <div class="flex justify-center">
        <x-botao id="btn_editar_usuario" label="Confirmar"></x-botao>
    </div>
</x-modal>
@vite('resources/js/funcionarios/editar.js')