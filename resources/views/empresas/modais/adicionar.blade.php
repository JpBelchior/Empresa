<x-modal id="modal_adicionar_empresa" label="Adicionar empresa">
    <x-input id="adicionar_empresa_razao_social" label="Razão Social" maxlength="255" obrigatorio="sim"></x-input>
    <x-input id="adicionar_empresa_cnpj" label="CNPJ" class="cnpj" obrigatorio="sim"></x-input>
    <x-input id="adicionar_empresa_email" label="Email" maxlength="255" obrigatorio="sim"></x-input>
    <x-input id="adicionar_empresa_whatsapp" label="Whatsapp" maxlength="20" obrigatorio="sim"></x-input>
    <x-input id="adicionar_empresa_qtd" label="Quantidade de usuários permitidos" type="number" obrigatorio="sim"></x-input>
    <div class="flex justify-center">
        <x-botao id="btn_adicionar_empresa" label="Confirmar"></x-botao>
    </div>
</x-modal>
@vite('resources/js/empresas/adicionar.js')