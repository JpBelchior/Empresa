@props([
    'risco_altissimo' => ''    
])
<div>
    @if($risco_altissimo == 'sim')
        <span class="bg-red-600 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm ">Risco altíssimo</span>
    @else
        <span class="bg-green-900 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm ">Risco insignificante</span>
    @endif
</div>