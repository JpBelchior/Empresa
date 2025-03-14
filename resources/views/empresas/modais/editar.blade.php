<x-modal id="modal_editar_empresa" label="Editar empresa">
    <x-input id="editar_empresa_id" type="hidden"></x-input>
    <x-input id="editar_empresa_razao_social" label="Razão Social" maxlength="255" obrigatorio="sim"></x-input>
    <x-input id="editar_empresa_cnpj" label="CNPJ" class="cnpj" obrigatorio="sim"></x-input>
    <x-input id="editar_empresa_email" label="Email" maxlength="255" obrigatorio="sim"></x-input>
    <x-input id="editar_empresa_whatsapp" label="Whatsapp" maxlength="20" obrigatorio="sim"></x-input>
    <x-input id="editar_empresa_qtd" label="Quantidade de usuários permitidos" type="number" obrigatorio="sim"></x-input>
    <x-checkbox id="editar_empresa_ativo" label="Ativo"></x-checkbox>
    <div class="flex justify-center">
        <x-botao id="btn_editar_empresa" label="Confirmar"></x-botao>
    </div>
</x-modal>
@vite('resources/js/empresas/editar.js')