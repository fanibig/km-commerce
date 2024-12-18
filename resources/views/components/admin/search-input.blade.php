@props(['name', 'value', 'placeholder' => 'Search...', 'btnName' => 'Search', 'route' => ''])
<div class="flex items-center justify-start">
    <form action="{{ $route }}" method="get" class="flex items-center justify-start">
        <input type="text" name="{{ $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}" class="px-4 py-2 w-full rounded-tl-md rounded-bl-md border border-gray-400 focus:outline-none focus:ring-0 focus-within:ring-none dark:bg-gray-700 dark:text-gray-400" required />
        <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded-tr-md rounded-br-md capitalize border border-indigo-500 dark:text-white dark:bg-gray-600 dark:border-gray-500">{{ $btnName }}</button>
    </form>
</div>
