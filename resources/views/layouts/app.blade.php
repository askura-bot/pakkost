<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
    <div class="flex flex-col min-h-screen">

        {{-- Navbar --}}
        @auth
            @if (auth()->user()->role === 'admin')
                @include('components.admin.navbar')
            @elseif (auth()->user()->role === 'pemilik')
                @include('components.pemilik.navbar')
            @endif
        @endauth

            {{-- Content --}}
            <main class="flex-grow" > 
                @yield('content')
            </main>
      
        {{-- Footer --}}
        @auth
            @if (auth()->user()->role === 'admin')
                @include('components.admin.footer')
            @elseif (auth()->user()->role === 'pemilik')
                @include('components.pemilik.footer')
            @endif
        @endauth

    </div>
   
</body>
</html>
