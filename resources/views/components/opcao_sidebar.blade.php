@props([
    'id' => '',
    'link' => '',
    'label' => '',
    'icon' => ''
])
<li>
    <a id="{{ $id }}" href="{{ $link }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
        <i class="{{ $icon }}"></i>
        <span class="flex-1 ms-3 whitespace-nowrap">{{ $label }}</span>
    </a>
</li>