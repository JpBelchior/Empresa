@props([
    'id' => '',
    'label' => '',
    'checked' => ''
])
<div class="flex items-start my-5">
    <div class="flex items-center h-5">
        <input id="{{ $id }}" type="checkbox" class="w-4 h-4 border border-gray-300 rounded-sm bg-gray-50 focus:ring-3 focus:ring-blue-300">
    </div>
    <label class="ms-2 text-sm font-medium text-gray-900">{{ $label }}</label>
</div>