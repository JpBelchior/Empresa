"""
Módulo de slides
"""
from .capa import gerar_capa
from .sumario import gerar_sumario
from .objetivos import gerar_objetivos
from .metodologia import gerar_metodologia
from .panorama_situacional import gerar_panorama_situacional 

__all__ = [
    'gerar_capa', 
    'gerar_sumario', 
    'gerar_objetivos', 
    'gerar_metodologia',
    'gerar_panorama_situacional'  
]