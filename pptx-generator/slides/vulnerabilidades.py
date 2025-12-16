#!/usr/bin/env python3
# -*- coding: utf-8 -*-
import sys
import os
from pptx.util import Inches, Pt
from pptx.enum.text import PP_ALIGN, MSO_ANCHOR
from pptx.enum.shapes import MSO_SHAPE
from pptx.dml.color import RGBColor
import base64
from io import BytesIO



def gerar_resumo_exec_det(pres, dados):

    slide = pres.slides.add_slide(pres.slide_layouts[6])
         # === FUNDO BRANCO === #
    fill = slide.background.fill
    fill.solid()
    fill.fore_color.rgb = RGBColor(220, 235, 255)
     # === PARALELOGRAMO AZUL  === #
    para_azul = slide.shapes.add_shape(
    MSO_SHAPE.PARALLELOGRAM,
    Inches(0.2),    # Left
    Inches(0.20),   # Top
    Inches(0.5),    # Width
    Inches(0.5)     # Height
)
    para_azul.fill.solid()
    para_azul.fill.fore_color.rgb = RGBColor(30, 115, 190)  # Azul
    para_azul.line.fill.background()

    tf_azul = para_azul.text_frame
    tf_azul.text = "7"  
    p_azul = tf_azul.paragraphs[0]
    p_azul.font.name = "Arial"
    p_azul.font.size = Pt(20)
    p_azul.font.bold = True
    p_azul.font.color.rgb = RGBColor(255, 255, 255)
    p_azul.alignment = PP_ALIGN.CENTER
    tf_azul.vertical_anchor = MSO_ANCHOR.MIDDLE

    # === PARALELOGRAMO CINZA  === #
  
    para_cinza = slide.shapes.add_shape(
    MSO_SHAPE.PARALLELOGRAM,
    Inches(0.85),   # Left
    Inches(0.20),   # Top
    Inches(5.0),    # Width
    Inches(0.5)     # Height
)
    para_cinza.fill.solid()
    para_cinza.fill.fore_color.rgb = RGBColor(70, 70, 70)  
    para_cinza.line.fill.background()

    tf_cinza = para_cinza.text_frame
    tf_cinza.text = "VULNERABILIDADES"  
    tf_cinza.vertical_anchor = MSO_ANCHOR.MIDDLE
    tf_cinza.margin_left = Inches(0.2)
    p_cinza = tf_cinza.paragraphs[0]
    p_cinza.alignment = PP_ALIGN.LEFT
    p_cinza.font.name = "Arial"
    p_cinza.font.size = Pt(14)
    p_cinza.font.bold = True
    p_cinza.font.color.rgb = RGBColor(255, 255, 255)

    subtitulo = slide.shapes.add_textbox(
        Inches(2.5),
        Inches(0.75),
        Inches(5.0),
        Inches(0.35)
    )

    tf_sub = subtitulo.text_frame
    tf_sub.clear()
    p_sub = tf_sub.paragraphs[0]
    p_sub.text = "Não Conformidades"
    p_sub.font.name = "Arial"
    p_sub.font.size = Pt(14)
    p_sub.font.italic = True
    p_sub.font.color.rgb = RGBColor(0, 38, 77)
    p_sub.alignment = PP_ALIGN.CENTER


    rows = 6
    cols = 7

    table_left = Inches(0.5)
    table_top = Inches(1.3)
    table_width = Inches(9.0)
    table_height = Inches(0.7 * rows)

    table_shape = slide.shapes.add_table(
        rows,
        cols,
        table_left,
        table_top,
        table_width,
        table_height
    )

    table = table_shape.table

    # === LARGURA DAS COLUNAS === #
    table.columns[0].width = Inches(1.0)   # Elementos
    table.columns[1].width = Inches(0.5)   # NC
    table.columns[2].width = Inches(2.0)   # Não Conformidade
    table.columns[3].width = Inches(2.0)   # Observação
    table.columns[4].width = Inches(1.5)   # Risco
    table.columns[5].width = Inches(1.0)   # Localização
    table.columns[6].width = Inches(1.0)   # Criticidade

# === ALTURA DAS LINHAS === #
    for row in table.rows:
        row.height = Inches(0.7)

    # === CABEÇALHO === #
    headers = [
        "Elementos",
        "NC",
        "Não Conformidade",
        "Observação",
        "Risco",
        "Localização",
        "Criticidade"
    ]

    for col_idx, header in enumerate(headers):
        cell = table.cell(0, col_idx)
        
        # Fundo azul
        cell.fill.solid()
        cell.fill.fore_color.rgb = RGBColor(0, 51, 102)
        
        # Texto
        tf = cell.text_frame
        tf.clear()
        p = tf.paragraphs[0]
        p.text = header
        p.font.name = "Arial"
        p.font.size = Pt(11)
        p.font.bold = True
        p.font.color.rgb = RGBColor(255, 255, 255)
        p.alignment = PP_ALIGN.CENTER

        tf.vertical_anchor = MSO_ANCHOR.MIDDLE

# === CENTRALIZAR TEXTO DAS DEMAIS CÉLULAS === #
    for row_idx in range(1, rows):
        for col_idx in range(cols):
            cell = table.cell(row_idx, col_idx)
            tf = cell.text_frame
            tf.vertical_anchor = MSO_ANCHOR.MIDDLE
            tf.paragraphs[0].alignment = PP_ALIGN.CENTER

    logo = dados.get("imagens", {}).get("logo_empresa")
    if logo:
        try:
            if ',' in logo:
                logo = logo.split(',')[1]
            
            img_data = base64.b64decode(logo)
            stream = BytesIO(img_data)
            
            slide.shapes.add_picture(
                stream,
                Inches(9.0),   # Canto direito
                Inches(4.5),   # Canto inferior
                width=Inches(0.9)
            )
        except Exception as e:
            print(f"Erro ao adicionar logo: {e}", file=sys.stderr, flush=True)
   
    print("✅ Slide de Vulnerabilidades criado!", file=sys.stderr)
    return slide 