<x-modal id="modal_relatorio" label="Gerar relatório">
    <h1 id="titulo_formulario_relatorio"></h1>
    <p>Para garantirmos a máxima precisão e qualidade na elaboração do seu relatório, precisamos que nos forneça as seguintes informações:</p>
    <form target="_blank" action="{{ getenv('APP_URL').'/formularios/relatorio_personalizado' }}" method="post" enctype="multipart/form-data">
        @csrf
        <x-input type="hidden" name="relatorio_formulario_id"></x-input>
        <x-input label="Nome da sua empresa" name="nome_empresa"></x-input>
        <x-input type="file" name="logo_empresa" label="Logo da sua empresa" accept="image/png, image/jpg, image/jpeg"></x-input>
        <x-input label="Nome do cliente" name="nome_cliente"></x-input>
        <x-input type="file" name="logo_cliente" label="Logo do cliente" accept="image/png, image/jpg, image/jpeg"></x-input>
        <x-input label="Objetivo" name="objetivo"></x-input>
        <x-input label="Observações" name="observacoes"></x-input>
        <x-input type="file" name="imagem_area" label="Imagens da área" accept="image/png, image/jpg, image/jpeg"></x-input>
        <x-input label="Localização da análise" name="localizacao_analise"></x-input>
        <x-input label="Referências próximas" name="referencias_proximas"></x-input>
        <x-textarea label="Panorama situacional - Exposição ao Risco" name="panorama"></x-textarea>        
        <x-botao type="submit" icon="fas fa-file-pdf" class="w-full" cor="vermelho"></x-botao>
    </form>
</x-modal>
@vite('resources/js/formularios/relatorio.js')