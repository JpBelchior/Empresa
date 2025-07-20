@props([
    'id' => '',
    'label' => '',
    'value' => '',
    'type' => '',
    'placeholder' => '',
    'class' => '',
    'maxlength' => '',
    'obrigatorio' => '',
    'accept' => '',
    'name' => ''
])
<div>
    <label class="block text-sm font-medium text-gray-900">{{ $label }} @if($obrigatorio == 'sim')<span class="text-red-600">*</span>@endif</label>
    <input
        name="{{ $name }}"
        type="{{ $type }}" 
        @if($id != '') id="{{ $id }}" @endif
        placeholder="{{ $placeholder }}" 
        value="{{ $value }}" 
        maxlength="{{ $maxlength }}" 
        @if($type == "file")
        accept="{{ $accept }}"
        @endif
        class="{{ $class }} mb-4 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">                
</div>