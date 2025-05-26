<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <style>[x-cloak] { display: none !important; }</style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-white dark:bg-gray-900 dark:text-gray-200 min-h-screen flex flex-col" x-data="{ open: false }">

        {{-- Navbar --}}
        @include('components.user.navbar')

        {{-- Header --}}
        @unless(request()->routeIs(['login','contact','detail']))
            @include('components.user.header')
        @endunless

        {{-- Content --}}
        @yield('content')

        {{-- Footer --}}
        @include('components.user.footer')

        @push('scripts') <!-- Pindahkan script Alpine.js ke bagian scripts -->
            <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        @endpush
    </body>
</html>
