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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Content -->
        <main class="flex flex-col min-h-screen">
            <div class="py-12">
                <div class="px-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="shadow-sm sm:rounded-lg">
                        <div class="flex flex-col items-center gap-8 text-gray-900 dark:text-gray-100">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <x-footer />
    </div>
    @if (session()->has('message'))
        <x-message :message="session()->get('message')" :success="true" />
    @endif
    @if (session()->has('error'))
        <x-message :message="session()->get('error')" :success="false" />
    @endif
</body>

</html>
