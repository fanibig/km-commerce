@props(['route' => null])

<form action="{{ $route }}" method="POST">
    @csrf
    @method('delete')
    <button type="submit" class="text-red-500 hover:text-red-900 dark:text-orange-700 dark:hover:text-red-400">Delete</button>
</form>
