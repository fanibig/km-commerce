@props(['href' => ''])
<a href="{{ $href }}" class="bg-green-500 text-green-50 border border-green-600 py-2 px-4 rounded-md hover:bg-green-900 shadow-sm uppercase text-sm dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white dark:border-gray-700">
    <i class="fa-solid fa-plus"></i> {{ $slot }}
</a>
