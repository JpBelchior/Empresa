@props([
    'prazo' => ''    
])
<div>    
    @switch($prazo)
    @case('Longo prazo')
        <span class="bg-green-900 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm ">Longo prazo</span>
        @break    
    @case('Médio prazo')
        <span class="bg-yellow-400 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm ">Médio prazo</span>
        @break
    @case('Curto prazo')
        <span class="bg-red-600 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm ">Curto prazo</span>
        @break     
    @endswitch    
</div>