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
        
        <div class="flex h-screen bg-gray-100">
            
            <aside class="w-64 bg-white shadow-lg flex flex-col">
                
                <div class="h-16 flex items-center justify-center border-b">
                    <span class="text-2xl font-bold text-green-600">SOFTLEARN</span>
                </div>

                <nav class="flex-1 p-4 space-y-2">
                    
                    <a href="{{ route('dashboard') }}" 
                       class="flex items-center space-x-3 px-4 py-2 rounded-md font-semibold
                              {{ request()->routeIs('dashboard') ? 'bg-green-100 text-green-700' : 'text-gray-600 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                        <span>Dashboard</span>
                    </a>
                    
                    <a href="{{ route('flashcards') }}" 
                       class="flex items-center space-x-3 px-4 py-2 rounded-md
                              {{ request()->routeIs('flashcards') ? 'bg-green-100 text-green-700' : 'text-gray-600 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M5 7h14"></path></svg>
                        <span>Flashcards</span>
                    </a>
                    
                    <a href="{{ route('diagramas') }}" 
                       class="flex items-center space-x-3 px-4 py-2 rounded-md
                              {{ request()->routeIs('diagramas') ? 'bg-green-100 text-green-700' : 'text-gray-600 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                        <span>Diagramas</span>
                    </a>
                    
                    <a href="{{ route('calendario') }}" 
                       class="flex items-center space-x-3 px-4 py-2 rounded-md
                              {{ request()->routeIs('calendario') ? 'bg-green-100 text-green-700' : 'text-gray-600 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span>Calendário</span>
                    </a>

                    <a href="{{ route('revisoes') }}" 
                       class="flex items-center space-x-3 px-4 py-2 rounded-md
                              {{ request()->routeIs('revisoes') ? 'bg-green-100 text-green-700' : 'text-gray-600 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v11.494m0 0l-5-5m5 5l5-5M12 21a9 9 0 100-18 9 9 0 000 18z"></path></svg>
                        <span>Revisões</span>
                    </a>

                    <a href="{{ route('informacoes') }}" 
                       class="flex items-center space-x-3 px-4 py-2 rounded-md
                              {{ request()->routeIs('informacoes') ? 'bg-green-100 text-green-700' : 'text-gray-600 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>Informações</span>
                    </a>
                </nav>

                <div class="p-4 border-t space-y-2">
                     <a href="{{ route('configuracoes') }}" 
                        class="flex items-center space-x-3 px-4 py-2 rounded-md
                               {{ request()->routeIs('configuracoes') ? 'bg-green-100 text-green-700' : 'text-gray-600 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.096 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span>Configurações</span>
                    </a>

                    <a href="{{ route('profile.edit') }}" 
                        class="flex items-center space-x-3 px-4 py-2 rounded-md
                               {{ request()->routeIs('profile.edit') ? 'bg-green-100 text-green-700' : 'text-gray-600 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <span>Perfil</span>
                    </a>

                    <a href="{{ route('meu-plano') }}" 
                        class="flex items-center space-x-3 px-4 py-2 rounded-md
                               {{ request()->routeIs('meu-plano') ? 'bg-green-100 text-green-700' : 'text-gray-600 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        <span>Meu Plano</span>
                    </a>
                </div>
            </aside>

            <div class="flex-1 flex flex-col overflow-hidden">
                
                <header class="h-16 bg-white shadow-sm flex items-center justify-between px-6">
                    
                    <div class="flex items-center space-x-6"> 
                        <a href="{{ route('dashboard') }}" 
                            class="font-semibold pb-1
                                    {{ request()->routeIs('dashboard') 
                                        ? 'text-gray-900 border-b-2 border-green-500' 
                                        : 'text-gray-500 hover:text-gray-900' }}">
                                Aprendizado
                        </a>
                        <a href="{{ route('competicao') }}" 
                            class="font-semibold pb-1
                                    {{ request()->routeIs('competicao') 
                                        ? 'text-gray-900 border-b-2 border-green-500' 
                                        : 'text-gray-500 hover:text-gray-900' }}">
                                Competição
                        </a>
                        <a href="{{ route('aulas') }}" 
                            class="font-semibold pb-1
                                    {{ request()->routeIs('aulas') 
                                        ? 'text-gray-900 border-b-2 border-green-500' 
                                        : 'text-gray-500 hover:text-gray-900' }}">
                                Aulas
                        </a>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                            <input type="text" placeholder="Buscar..." class="border rounded-full py-1.5 pl-10 pr-4 text-sm w-64 focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                        
                        <a href="#" class="text-gray-500 hover:text-gray-700 p-1 rounded-full hover:bg-gray-100">
                             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-700 p-1 rounded-full hover:bg-gray-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341A6.002 6.002 0 006 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-700 p-1 rounded-full hover:bg-gray-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                        </a>

                        <div class="flex items-center space-x-2">
                            <img class="h-8 w-8 rounded-full object-cover" 
                                src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim(Auth::user()->email))) }}?d=mp" 
                                alt="{{ Auth::user()->name }}">

                            <span class="text-gray-700 font-semibold text-sm">
                                {{ Auth::user()->name }}
                            </span>
                        </div>
                    </div>
                </header>
                
                <main class="flex-1 overflow-y-auto p-6">
                    
                    {{ $slot }}

                </main>
            </div>

        </div>
    </body>
</html>