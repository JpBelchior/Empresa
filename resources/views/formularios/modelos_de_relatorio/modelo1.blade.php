@php
$respostas = $dados_modelo['respostas'];
@endphp
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title>{{ $dados->nome_empresa }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>

    #conteudo{
      display: none;
    }

    /* Força o Tailwind a imprimir cores */
    :root {
      --azul-escuro: #4682B4;
      --azul-claro: #87CEFA;
      --azul-clarissimo: #e7e8ec;
      --texto: #114769;
      --titulo: #004aad;
      --cabecalho: #004aad;
      --paragrafo: #114769;
    }    

    .vermelho-escuro {
      background-color: #8B0000 !important;      
    }

    /* DarkRed */
    .laranja {
      background-color: #FFA500 !important;
    }

    /* Orange */
    .amarelo {
      background-color: #FFD700 !important;
    }

    /* Gold */
    .verde-escuro {
      background-color: #006400 !important;
    }

    /* DarkGreen */
    .verde-claro {
      background-color: #90EE90 !important
    }

    /* LightGreen */      


    @media print and (max-width: 768px) {
      .quebra-pagina-normal {
        min-height: auto !important;
        page-break-after: avoid !important;
        overflow: hidden !important;
      }
    }

    @media print {
    #conteudo{
      display: block;
    }
      .btn-print {
        display: none !important;
      }
      * {
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
      }

       @font-face {
        font-family: 'Garet';
        src: url('{{ asset('fonts/Garet.ttf') }}');
      }

      @font-face {
        font-family: 'OpenSans';
        src: url('{{ asset('fonts/OpenSans.ttf') }}');
      }

      /* Cores */

      @page {
        size: A4;
        margin: 0;        
      }      

      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: white;
      }

      .quebra-pagina .rodape {        
        bottom: 0;
        left: 0;
        right: 0;
        height: 1.25cm;
        text-align: center;
        font-size: 12px;
        color: #555;
        border-top: 1px solid #ccc;
        padding-top: 2px;
        margin-right: 10px;
        margin-left: 10px;
      }

      .quebra-pagina {
        display: flex;
        flex-direction: row;
        width: 100%;
        height: 29.7cm;
        page-break-after: always;
        break-after: page;
      }

      .quebra-pagina-normal {
        width: 100%;
        min-height: 100vh;
        box-sizing: border-box;
        page-break-after: always !important;
        page-break-inside: avoid !important;
      }

      .externo_azul {
        width: 250px;
        height: 250px;
        border: 20px solid var(--azul-escuro);
        border-radius: 50%;

        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .externo {
        width: 450px;
        height: 450px;
        border: 10px solid white;
        border-radius: 50%;

        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .interno {
        width: 220px;
        height: 220px;
        border: 10px solid white;
        border-radius: 50%;

        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
      }

      .paragrafo, p {
        font-family: 'OpenSans';
        margin-left: 100px;
        margin-right: 100px;
        font-size: 20px;
        color: var(--paragrafo);
      }

      .cabecalho {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 150px;
      }

      .cabecalho .titulo {
        font-family: 'Garet';
        font-size: 30px;
        font-weight: bolder;
        color: var(--titulo);
        text-align: center;
      }

      /*PAGINA 1*/
      #pagina2_divisao_azul,
      #pagina1_divisao_azul {
        flex: 1;
        background-color: var(--azul-escuro);
      }

      #pagina2_divisao_azul_circulo_circulo,
      #pagina1_divisao_azul_circulo_circulo {
        margin-top: -1100px;
        margin-left: -200px;
      }

      #pagina2_divisao_azul_divisao,
      #pagina1_divisao_azul_divisao {
        display: flex;
        flex-direction: row;
        width: 100%;
        height: 100%;
      }

      #pagina2_divisao_azul_circulo,
      #pagina1_divisao_azul_circulo {
        flex: 1;
        background-color: var(--azul-claro);
        display: flex;
        justify-content: center;
        align-items: center;
      }

      #pagina2_divisao_azul_tarja,
      #pagina1_divisao_azul_tarja {
        width: 5mm;
        /* tarja fina */

        display: flex;
        justify-content: center;
        align-items: center;
        writing-mode: vertical-rl;
        font-size: 12px;
      }

      #pagina2_divisao_branca,
      #pagina1_divisao_branca {
        flex: 2;
        padding-left: 30px;
      }

      #pagina1_logo_empresa img {
        width: 100px !important;
        height: 100px !important;
        margin: 10px;        
        object-fit: contain;
        /* Ou use 'cover' dependendo do que preferir */
      }

      #pagina1_divisao1 {
        margin-top: 250px;
        margin-bottom: 200px;
      }

      #pagina1_data {
        font-size: 30px;
      }

      #pagina1_analise_risco {
        font-size: 60px;
      }

      .pagina1_dizeres {
        font-size: 20px;
        font-weight: bold;
      }

      /*PAGINA 2 */
      #pagina2_divisao_branca h2 {
        font-size: 70px;
        margin-bottom: 200px;
      }

      #pagina2_divisao_branca p {
        margin-bottom: 30px;
      }

      /*PAGINA 3 */
      #pagina3_metodologia img {
        width: 105%;
      }

      /*PAGINA 4 */
      #pagina4_imagem {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
      }

      #pagina4_imagem img {
        width: 350px;
        height: 350px;
      }

      #conforme{
        margin-left: 90px;
        margin-right: 90px;
      }

      /*PAGINA 5 */
      .circulo_resumo {
        width: 150px;
        height: 150px;
        border: 10px solid var(--azul-escuro);
        border-radius: 50%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
      }

      .circulo_resumo div {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
      }

      .circulo_resumo p {
        text-align: center;
        font-size: 130%;
        color: var(--azul-escuro);
      }

      .circulo_resumo img {
        width: 70%;
      }

      .alinhado-meio {
        padding-left: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: var(--azul-escuro);
      }

      .alinhado-meio p:first-child {
        font-size: 25px;
        font-weight: bold;
      }

      .alinhado-meio p:nth-of-type(2) {
        font-size: 20px;
      }

      /*PAGINA 6 */

      .resumo_sessao {
        border: 1px solid var(--azul-escuro);
        border-radius: 20px;
        height: 180px;
        display: flex;
      }

      .resumo_sessao .primeira-divisao {
        flex: 1;
        border-right: 1px solid var(--azul-escuro);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
      }

      .resumo_sessao .segunda-divisao {
        padding-top: 10px;
        flex: 4;
        text-align: center;
        display: flex;
        flex-direction: row;
        justify-content: space-around;
      }

      .grafico {
        width: 100px;
        height: 100px;
        display: block;
        margin: auto;
      }

      .texto {
        font-size: 10px;
        font-weight: bold;
        fill: #1f2937;
      }

      /*PAGINA 7 */
      .circulo {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: gray;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: sans-serif;
        color: white;
        font-weight: bold;
        font-size: 1rem;
        margin: 1px;
      }

      .img_tabela {
        width:30%;
      }

      thead {
        background-color: var(--azul-escuro);
        color: white;
        font-weight: bold;
        text-align: center;
      }

      td {
        background-color: var(--azul-clarissimo);
        color: black;
        text-align: center;
        border: 2px solid white;
      }
    }
  </style>
</head>

<body>
  <div class="btn-print fixed bottom-4 right-4 z-50">
    <button onclick="window.print()" 
      class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-lg">
      Imprimir
    </button>
  </div>
  <div id="conteudo">
  <div id="pagina1" class="quebra-pagina sem-rodape">
    <div id="pagina1_divisao_azul">
      <div id="pagina1_divisao_azul_divisao">
        <div id="pagina1_divisao_azul_circulo">
          <div id="pagina1_divisao_azul_circulo_circulo">
            <div class="externo">
              <div class="interno"></div>
            </div>
          </div>
        </div>
        <div id="pagina1_divisao_azul_tarja"></div>
      </div>
    </div>
    <div id="pagina1_divisao_branca">
      <div class="flex justify-end">
        <div id="pagina1_logo_empresa">
          <img src="{{ $imagens['logo_empresa'] }}" alt="">
        </div>
      </div>
      <div id="pagina1_divisao1">
        <p id="pagina1_data" style="color:black !important">{{ date('d/m/Y') }}</p>
        <p id="pagina1_analise_risco" style="color:black !important">ANÁLISE <br> DE RISCO</p>
        <p style="color:black !important">Conformidade e segurança se alcançam <br> com a análise de riscos aplicada</p>
      </div>
      <div class="mb-4">
        <p style="color:black !important" class="pagina1_dizeres">Preparado para:</p>
        <p style="color:black !important" class="dizeres_sumario">{{ $dados->nome_cliente }}</p>
      </div>
      <div>
        <p style="color:black !important" class="pagina1_dizeres">Elaborado por:</p>
        <p style="color:black !important" class="dizeres_sumario">{{ $dados->nome_empresa }}</p>
      </div>      
    </div>
  </div>
  <div class="quebra-pagina sem-rodape">
    <div id="pagina2_divisao_azul">
      <div id="pagina2_divisao_azul_divisao">
        <div id="pagina2_divisao_azul_circulo">
          <div id="pagina2_divisao_azul_circulo_circulo">            
          </div>
        </div>
        <div id="pagina2_divisao_azul_tarja"></div>
      </div>
    </div>
    <div id="pagina2_divisao_branca">
      <h2>SUMÁRIO</h2>
      <p class="pagina1_dizeres">OBJETIVO</p>
      <p class="pagina1_dizeres">METODOLOGIA</p>
      <p class="pagina1_dizeres">PANORAMA SITUACIONAL</p>
      <p class="pagina1_dizeres">RESUMO EXECUTIVO</p>
      <P class="pagina1_dizeres">NÃO CONFORMIDADES - NC</P>
      <p class="pagina1_dizeres">RECOMENDAÇÕES</p>
    </div>
  </div>
  <div class="quebra-pagina-normal">
    <div class="cabecalho">
      <p class="titulo">OBJETIVO</p>
    </div>
    <div id="pagina3_imagem">
      <img src="{{ asset('img/camera.png') }}" alt="" srcset="" class="w-full">
    </div>
    <div class="p-4">
      <p class="paragrafo">Realizar análise de riscos para elevar o nível de segurança da {{ $dados->localizacao_analise }}, propondo soluções priorizadas para mitigar vulnerabilidades identificadas. O trabalho contempla: identificação dos riscos efragilidades; definição das recomendações mais adequadas;classificação por criticidade; consolidação dos resultados em relatórioexecutivo, permitindo ao {{ $dados->nome_empresa }} planejar ações corretivase prevenir incidentes que possam impactar pessoas, ativos e operação,de forma contínua e eficaz.</p>
      <p class="paragrafo">{{ $dados->objetivo }}</p>
    </div>
      <!-- <div class="rodape flex justify-between">
        <p>Análise de riscos</p>
        <p>{{ $dados->nome_cliente }}</p>
        <p>{{ $dados->nome_empresa }}</p>
      </div> -->
  </div>
  <div class="quebra-pagina-normal">
    <div class="cabecalho">
      <p class="titulo">METODOLOGIA</p>
    </div>
    <p class="paragrafo text-center">Identificando vulnerabilidades <br> e deficiências em 5 etapas:</p>
    <div id="pagina3_metodologia" class="flex justify-center">
      <img src="{{ asset('img/pilares.png') }}" alt="">
    </div>
  </div>
  <div class="quebra-pagina-normal">
    <div class="cabecalho">
      <p class="titulo">PANORAMA SITUACIONAL</p>
    </div>
    <p class="paragrafo text-center mb-4">Contextualização da análise</p>
    <div id="pagina4_imagem">
      <img src="{{ $imagens['imagem_area'] }}" alt="" srcset="">
    </div>
    <p class="paragrafo text-center my-4">Referências próximas</p>
    <p class="paragrafo mt-4">{{ $dados->referencias_proximas }}</p>
    <p class="paragrafo text-center mb-4">Panorama situacional - Exposição ao Risco</p>
    <p class="paragrafo mt-4">{{ $dados->panorama }}</p>
  </div>
  <div class="quebra-pagina-normal">
    <div class="cabecalho">
      <p class="titulo">RESUMO EXECUTIVO</p>
    </div>
    <div id="conforme" class="mx-4">
      <div class="flex">
        <div class="circulo_resumo">
          <div>
            <img src="{{ asset('img/simbolo_pessoas.png') }}" alt="">
            <p>{{ $dados_modelo["porcentagem_pilar"]["Pessoas"] }} %</p>
          </div>
        </div>
        <div class="alinhado-meio">
          <div>
            <p>PESSOAS - CONFORME</p>
            <p>Cultura de segurança internalizadapor todos os times.</p>
          </div>
        </div>
      </div>
      <div class="flex">
        <div class="alinhado-meio text-end">
          <div>
            <p>PROCESSOS - CONFORME</p>
            <p>Revisão contínua alinha fluxos a padrões de controles.</p>
          </div>
        </div>
        <div class="circulo_resumo ms-4">
          <div>
            <img src="{{ asset('img/simbolo_processos.png') }}" alt="">
            <p>{{ $dados_modelo["porcentagem_pilar"]["Processos"] }} %</p>
          </div>
        </div>
      </div>
      <div class="flex">
        <div class="circulo_resumo">
          <div>
            <img src="{{ asset('img/simbolo_gestao.png') }}" alt="">
            <p>{{ $dados_modelo["porcentagem_pilar"]["Gestão"] }} %</p>
          </div>
        </div>
        <div class="alinhado-meio">
          <div>
            <p>GESTÃO - CONFORME</p>
            <p>Governança de riscos impulsiona decisões mais seguras.</p>
          </div>
        </div>
      </div>
      <div class="flex">
        <div class="alinhado-meio text-end">
          <div>
            <p>TECNOLOGIA - CONFORME</p>
            <p>Tecnologias atuais ampliam vigilância e pronta reação.</p>
          </div>
        </div>
        <div class="circulo_resumo ms-4">
          <div>
            <img src="{{ asset('img/simbolo_tecnologia.png') }}" alt="">
            <p>{{ $dados_modelo["porcentagem_pilar"]["Tecnologia"] }} %</p>
          </div>
        </div>
      </div>
      <div class="flex">
        <div class="circulo_resumo">
          <div>
            <img style="width: 60%" src="{{ asset('img/simbolo_informacao.png') }}" alt="">
            <p>{{ $dados_modelo["porcentagem_pilar"]["Informação"] }} %</p>
          </div>
        </div>
        <div class="alinhado-meio">
          <div>
            <p>INFORMAÇÃO - CONFORME</p>
            <p>Políticas protegem dados e garantem integridade plena.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="quebra-pagina-normal">
    <div class="cabecalho">
      <p class="titulo">NÃO CONFORMIDADES - NC</p>
    </div>
    <div style="margin-left:70px;margin-right:70px" class="relative overflow-x-auto">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs uppercase">
          <tr>
            <th scope="col" class="px-6 py-3">
              Elementos
            </th>
            <th scope="col" class="px-6 py-3">
              NC
            </th>
            <th scope="col" class="px-6 py-3">
              Não conformidade
            </th>
            <th scope="col" class="px-6 py-3">
              Criticidade
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach($respostas as $resposta)
          @if($resposta['vulnerabilidade'] != 1)
          <tr class="border-b border-gray-200">
            <td class="">
              <div class="flex justify-center">
                <img class="img_tabela" src="{{ $resposta['pilar'] }}" alt="">
              </div>
            </td>
            <td class="">
              NC - {{ $resposta['nc'] }}
            </td>
            <td class="">
              {{ $resposta['topicos'] }} - {{ $resposta['nao_conformidade'] }}
            </td>
            <td class="flex justify-center">
              <div class="circulo {{ $resposta['criticidade'] }}"></div>
            </td>
          </tr>
          @endif
          @endforeach
        </tbody>
      </table>
      <div>
        <img src="{{ asset('img/rodape_conformidade.png') }}" alt="" srcset="">
      </div>
    </div>

  </div>
  <div class="quebra-pagina-normal">
    <div class="cabecalho">
      <p class="titulo">RECOMENDAÇÕES</p>
    </div>
    @php $pos = 1; @endphp
    <div style="margin-left:70px;margin-right:70px" class="relative overflow-x-auto">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs uppercase">
          <tr>
            <th scope="col" class="px-6 py-3">
              Elementos
            </th>
            <th scope="col" class="px-6 py-3">
              NC
            </th>
            <th scope="col" class="px-6 py-3">
              Recomendações
            </th>
            <th scope="col" class="px-6 py-3">
              Prioridade
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach($respostas as $resposta)
          @if($resposta['risco'])
          <tr class="border-b border-gray-200">
            <td class="">
              <div class="flex justify-center">
                <img class="img_tabela" src="{{ $resposta['pilar'] }}" alt="">
              </div>
            </td>
            <td class="">
              NC - {{ $pos }}
            </td>
            <td class="">
              {{ $resposta['recomendacao'] }}
            </td>
            <td class="flex justify-center">
              <div class="circulo {{ $resposta['prioridade'] }}"></div>
            </td>
          </tr>
          @php $pos++; @endphp
          @endif
          @endforeach

        </tbody>
      </table>
      <div>
        <img src="{{ asset('img/rodape_recomendacao.png') }}" alt="" srcset="">
      </div>
    </div>
  </div>
  </div>
  <script>
   // Detecta se é mobile ou desktop
    function isMobile() {
      return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i
        .test(navigator.userAgent);
    }

    window.onload = function() {
      if (!isMobile()) {
        // No desktop: imprime automaticamente
        window.print();
      } else {
        // No mobile: mostra botão de imprimir
        document.querySelector(".btn-print").style.display = "block";
      }
    }
  </script>
</body>

</html>