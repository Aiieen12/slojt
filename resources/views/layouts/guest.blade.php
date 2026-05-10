<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600;outfit:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-[linear-gradient(135deg,_#e0f2fe_0%,_#f8fafc_30%,_#ecfeff_65%,_#f8fafc_100%)] font-['Outfit',sans-serif] text-slate-900 antialiased">
        <div class="relative flex min-h-screen items-center justify-center overflow-hidden px-4 py-5 sm:px-6 lg:px-8">
            <div class="pointer-events-none absolute inset-0 overflow-hidden">
                <div class="absolute -left-20 top-10 h-56 w-56 rounded-full bg-sky-200/45 blur-3xl sm:h-72 sm:w-72"></div>
                <div class="absolute right-0 top-1/4 h-64 w-64 rounded-full bg-cyan-200/40 blur-3xl sm:h-80 sm:w-80"></div>
                <div class="absolute bottom-0 left-1/4 h-72 w-72 rounded-full bg-emerald-100/40 blur-3xl sm:h-96 sm:w-96"></div>
            </div>

            <div class="relative w-full max-w-6xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
