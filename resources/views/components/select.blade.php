@props([
    'id' => '',        
    'label' => '',
    'obrigatorio' => '',
    'placeholder' => '',
    'multiple' => ''
])
<div class="">
  <label class="block mb-2 text-sm font-medium text-gray-900">{{ $label }} @if($obrigatorio == 'sim')<span class="text-red-600">*</span>@endif</label>
  <select id="{{ $id }}" @if($multiple == 'sim') multiple @endif placeholder="{{ $placeholder }}" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
    {{ $slot }}
  </select>
</div>