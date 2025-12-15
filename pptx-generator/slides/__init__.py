"""
Módulo de slides
"""
from .capa import gerar_capa
from .sumario import gerar_sumario
from .objetivos import gerar_objetivos
from .metodologia import gerar_metodologia
from .panorama_situacional import gerar_panorama_situacional 
from .seguranca import gerar_seguranca
from .resumo_exec import gerar_resumo_exec
from .resumo_exec_det import gerar_resumo_exec_det

__all__ = [
    'gerar_capa', 
    'gerar_sumario', 
    'gerar_objetivos', 
    'gerar_metodologia',
    'gerar_panorama_situacional',  
    'gerar_seguranca',
    'gerar_resumo_exec',
    'gerar_resumo_exec_det'
]