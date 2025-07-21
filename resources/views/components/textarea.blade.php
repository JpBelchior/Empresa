@props([
    'id' => '',
    'label' => '',
    'value' => '',    
    'placeholder' => '',
    'class' => '',
    'maxlength' => '',
    'obrigatorio' => '',
    'name' => ''
])
<div>    
    <label class="block mb-2 text-sm font-medium text-gray-900">{{ $label }}</label>
    <textarea name="{{ $name }}" @if($id != '') id="{{ $id }}" @endif placeholder="{{ $placeholder }}" rows="4" class="{{ $class }} block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
</div>