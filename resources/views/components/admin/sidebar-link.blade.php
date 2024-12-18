@props(['active' => false, 'icon' => ''])

@php
$classes = $active
        ? "sidebar-link flex items-center justify-start p-1 bg-gray-200 bg-opacity-100 text-black px-2 py-1.5 dark:bg-gray-800 dark:text-white"
        : "sidebar-link flex items-center justify-start p-1 group-hover:bg-gray-500 group-hover:bg-opacity-20 text-white px-2 py-1.5 dark:text-white";

    $icon_class = $active
        ? 'menu-icon inline-flex items-center justify-center rounded-md group-hover:bg-gary-800 mr-3 group-hover:text-black bg-white text-black dark:text-white dark:bg-gray-600 dark:group-hover:text-white'
        : 'menu-icon inline-flex items-center justify-center rounded-md group-hover:bg-gray-800 mr-3 text-black group-hover:text-white dark:text-white';

    $menuItemClasses = "sidebar-menu-item group transition duration-500 ease-in-out border-t border-gray-100 dark:border-gray-500 border-opacity-20 relative first:border-t-0";

    $textClass = $active ? "menu-title inline-flex items-center text-black dark:text-white" :"menu-title inline-flex items-center text-black dark:text-white";
@endphp

<li class="{{ $menuItemClasses }}">
    <a {{ $attributes->merge(['class' => $classes]) }}>
        @if ($icon !== '')
            <span class="{{ $icon_class }}">
               {{ $icon }}
            </span>
        @endif
        <span class="{{ $textClass }}">{{ $slot }}</span>
    </a>
</li>
