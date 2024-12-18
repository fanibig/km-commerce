@props(['href' => ''])

<a href="{{ $href }}" class="bg-emerald-600 border border-emerald-700 text-white py-2 px-4 rounded-md hover:bg-emerald-900 shadow-sm uppercase text-sm dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white dark:border-gray-700">
    <i class="fa-solid fa-arrow-left"></i> {{ $slot }}
</a>
