<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body x-data="{ theme: localStorage.getItem('theme') || 'light' }"
        x-init="$watch('theme', value => localStorage.setItem('theme', value))"
        x-bind:class="{ 'dark': theme === 'dark' }">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 dark:bg-gray-900">
        <div class="brand-logo mb-4">
            <img src="{{ asset('storage/' . $webConfig['siteLogo']) }}" alt="{{ $webConfig['siteName'] }}" class="w-full max-w-28">
        </div>
        <div class="authenticated max-w-lg w-full">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
