@props(['active' => false])
@php
$classes = $active
    ? 'block w-full px-4 py-2 text-black text-start text-sm leading-5 text-white bg-gray-800 hover:bg-gray-300 focus:outline-none focus:text-gray-100 focus:bg-gray-800 hover:text-white transition duration-150 ease-in-out dark:bg-white dark:text-gray-800 dark:group-hover:bg-gray-50 dark:hover:bg-gray-100 dark:hover:text-gray-800 dark:focus:bg-gray-100 dark:focus:text-gray-800'
    : 'block w-full px-4 py-2 text-black text-start text-sm leading-5 text-gray-800 hover:bg-gray-300 focus:outline-none focus:text-gray-100 focus:bg-gray-800 hover:text-gray-800 transition duration-150 ease-in-out dark:text-white dark:text-gray-800 dark:group-hover:bg-gray-50 dark:hover:bg-gray-100 dark:hover:text-gray-800 dark:focus:bg-gray-100 dark:focus:text-gray-800';
@endphp
<a {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
