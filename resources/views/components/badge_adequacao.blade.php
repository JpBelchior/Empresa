@props([
    'nivel_adequacao' => ''    
])
<div>
    @switch($nivel_adequacao)
    @case('1')
        <span class="bg-green-900 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm ">Atende plenamente</span>
        @break
    @case('2')
        <span class="bg-green-600 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm ">Atende após ajustes</span>
        @break
    @case('3')
        <span class="bg-yellow-400 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm ">Atende após ajustes médios</span>
        @break
    @case('4')
        <span class="bg-red-600 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm ">Não atende</span>
        @break
    @default
        <span class="bg-gray-400 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm ">Não existe</span>
        @break
    @endswitch    
</div>