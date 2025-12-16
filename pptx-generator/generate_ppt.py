#!/usr/bin/env python3
# -*- coding: utf-8 -*-
import sys
import json
from io import BytesIO
from pptx import Presentation
from pptx.util import Inches
from slides.capa import gerar_capa
from slides.sumario import gerar_sumario
from slides.objetivos import gerar_objetivos
from slides.metodologia import gerar_metodologia
from slides.panorama_situacional import gerar_panorama_situacional 
from slides.seguranca import gerar_seguranca
from slides.resumo_exec import gerar_resumo_exec
from slides.resumo_exec_det import gerar_resumo_exec_det


def main():
    try:
        print("Lendo dados...", file=sys.stderr, flush=True)
        dados = json.load(sys.stdin)
        
        print("Criando apresentacao...", file=sys.stderr, flush=True)
        pres = Presentation()
        pres.slide_width = Inches(10)
        pres.slide_height = Inches(5.625)
        
        print("Gerando capa...", file=sys.stderr, flush=True)
        gerar_capa(pres, dados)
        
        print("Gerando sumário...", file=sys.stderr, flush=True)
        gerar_sumario(pres, dados)
        
        print("Gerando objetivos...", file=sys.stderr, flush=True) 
        gerar_objetivos(pres, dados)  

        print("Gerando metodologia...", file=sys.stderr, flush=True) 
        gerar_metodologia(pres, dados)      

        print("Gerando panorama situacional...", file=sys.stderr, flush=True)  # ← NOVO
        gerar_panorama_situacional(pres, dados)  

        print("Gerando segurança...", file=sys.stderr, flush=True) 
        gerar_seguranca(pres, dados)  
        
        print("Gerando resumo executivo...", file=sys.stderr, flush=True) 
        gerar_resumo_exec(pres, dados)  

        print("Gerando resumo executivo detalhado...", file=sys.stderr, flush=True)
        analise_topicos = dados.get("dados_modelo", {}).get("analise_topicos", {})
        if not analise_topicos:
            print("⚠️ Nenhum tópico encontrado em 'analise_topicos'", file=sys.stderr, flush=True)
        else:
            for pilar, topicos in analise_topicos.items():
                print(f"📌 Pilar: {pilar} - {len(topicos)} tópicos recebidos", file=sys.stderr, flush=True)
                for j, t in enumerate(topicos):
                    nome = t.get("topico_nome") or t.get("topico", "")  # dependendo de como os dados chegam
                    fracao = t.get("fracao", "")
                    porcentagem = t.get("porcentagem", "")
                    print(f"   → Topico {j+1}: {nome}, fracao: {fracao}, %: {porcentagem}", file=sys.stderr, flush=True)
        gerar_resumo_exec_det(pres, dados)
        print("Salvando...", file=sys.stderr, flush=True)
        output = BytesIO()
        pres.save(output)
        buffer_data = output.getvalue()
        
        print(f"Tamanho: {len(buffer_data)} bytes", file=sys.stderr, flush=True)
        
        sys.stdout.buffer.write(buffer_data)
        sys.stdout.buffer.flush()
        
        print("Enviado!", file=sys.stderr, flush=True)
        
    except Exception as e:
        print(f"ERRO: {str(e)}", file=sys.stderr, flush=True)
        import traceback
        traceback.print_exc(file=sys.stderr)
        sys.exit(1)


if __name__ == "__main__":
    main()