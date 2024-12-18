@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-16 bg-white dark:bg-gray-900'])

@php
switch ($align) {
    case 'left':
        $alignmentClasses = 'origin-top-left left-0';
        break;
    case 'top':
        $alignmentClasses = 'origin-top';
        break;
    case 'right':
    default:
        $alignmentClasses = 'top-0 left-full';
        break;
}

switch ($width) {
    case '48':
        $width = 'w-48';
        break;
}
@endphp

<div class="border-t border-gray-200" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div @click="open = ! open">
        {{ $trigger }}
    </div>

    <div x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="absolute z-50 {{ $width }} shadow-lg {{ $alignmentClasses }}"
            style="display: none;"
            @click="open = false">
        <div class="ring-1 ring-black ring-opacity-5 h-screen {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>