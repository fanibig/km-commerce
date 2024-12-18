
<button type="submit" {!! $attributes->merge(['class' => 'bg-blue-500 hover:bg-blue-800 text-white font-bold py-2 px-4 min-w-32 rounded capitalize dark:bg-gray-700 dark:hover:bg-gray-600']) !!}>
    {{ $slot }}
</button>
