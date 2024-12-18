<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.backend.head')
    {{-- Loads Inter --}}
    @googlefonts()
</head>

<body class="font-sans antialiased"  x-data="{ theme: localStorage.getItem('theme') || 'light' }"
        x-init="$watch('theme', value => localStorage.setItem('theme', value))"
        x-bind:class="{ 'dark': theme === 'dark' }">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.backend.sidebar')
        <div class="main-content ml-48">
            @include('layouts.backend.header')
            <!-- Page Heading -->
            @isset($header)
                <x-admin.page-heading>
                    {{ $header }}
                </x-admin.page-heading>
            @endisset
            <!-- Page Content -->
            <main class="px-4">
                <div class="container w-full max-w-full">
                    {{ $slot }}
                </div>
            </main>
            @include('layouts.backend.footer')
        </div>
    </div>
</body>
</html>
