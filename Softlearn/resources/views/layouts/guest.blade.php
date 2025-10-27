<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        
        <div class="flex min-h-screen bg-gray-100">

            <div class="flex-1 flex flex-col overflow-hidden">
                
                <header class="h-16 bg-white shadow-sm flex items-center justify-between px-6">

                    <div class="h-16 flex items-center justify-center border-b">
                        <span class="text-2xl font-bold text-green-600">SOFTLEARN</span>
                    </div>

                    <div class="flex items-center space-x-5">
                        
                        <a href="#" class="text-gray-500 hover:text-gray-700 p-1 rounded-full hover:bg-gray-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                        </a>

                    </div>
                </header>
                
                <main class="flex items-center justify-center min-h-screen">
                    {{ $slot }}    
                </main>
            </div>

        </div>
    </body>
</html>