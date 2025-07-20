@props([
    'cor' => '',
    'id' => '',
    'label' => '',
    'icon' => '',
    'propriedade' => '',
    'class' => '',
    'type' => 'button'
])
<div class="mt-3">
    <button type="{{ $type }}" propriedade="{{ $propriedade }}" type="button" @if($id != '') id="{{ $id }}" @endif
        @switch($cor)
        @case('verde')
        class="{{ $class }} flex justify-center focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2"
        @break
        @case('vermelho')
        class="{{ $class }} flex justify-center focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2"
        @break
        @default
        class="{{ $class }} flex justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none"
        @break
        @endswitch>
        <span>
            <i class="{{ $icon }}"></i>
            {{ $label }}
        </span>
    </button>
</div>