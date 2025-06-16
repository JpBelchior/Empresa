<x-modal id="modal_relatorio" label="Gerar relatório">
    <h1 id="titulo_formulario_relatorio"></h1>
    <p>Para garantirmos a máxima precisão e qualidade na elaboração do seu relatório, precisamos que nos forneça as seguintes informações:</p>
    <x-input label="Nome da sua empresa"></x-input>
    <x-input type="file" label="Logo da sua empresa" accept="image/png, image/jpg, image/jpeg"></x-input>
    <x-input label="Nome do cliente"></x-input>
    <x-input type="file" label="Logo do cliente" accept="image/png, image/jpg, image/jpeg"></x-input>
    <x-input label="Observações"></x-input>
    <x-input type="file" label="Imagens da área" accept="image/png, image/jpg, image/jpeg"></x-input>
    <x-input label="Localização da análise"></x-input>
    <x-input label="Referências próximas"></x-input>
    <x-textarea label="Panorama situacional - Exposição ao Risco"></x-textarea>
    <x-botao icon="fas fa-file-pdf" class="w-full" cor="vermelho"></x-botao>
</x-modal>
@vite('resources/js/formularios/relatorio.js')