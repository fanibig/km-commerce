@props(['route'=> null])

<a href="{{ $route }}"
    class="user-title group-hover:text-blue-700 text-sm text-blue-400 dark:text-blue-300 dark:group-hover:text-blue-600 flex items-center justify-start capitalize"
>
    {{ $slot }}
</a>
