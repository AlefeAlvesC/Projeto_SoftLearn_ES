<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <h1 class="text-3xl font-bold text-gray-900 mb-6">
                Bem-vindo, {{ Auth::user()->name }}!
            </h1>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <div class="lg:col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-xl font-semibold mb-4">Exercícios resolvidos da semana</h3>
                    
                    <div class="flex flex-col md:flex-row items-center justify-between">
                        <div class="w-48 h-48 mb-4 md:mb-0">
                            <img src="https://via.placeholder.com/200" alt="Gráfico de Pizza" class="rounded-full">
                        </div>

                        <ul class="space-y-2 text-sm">
                            <li class="flex items-center">
                                <span class="w-3 h-3 rounded-full bg-red-500 mr-2"></span> Flash Cards
                            </li>
                            <li class="flex items-center">
                                <span class="w-3 h-3 rounded-full bg-blue-500 mr-2"></span> Diagramas
                            </li>
                            <li class="flex items-center">
                                <span class="w-3 h-3 rounded-full bg-yellow-500 mr-2"></span> Revisões
                            </li>
                        </ul>

                        <div>
                            <img src="https://via.placeholder.com/128" alt="Coruja" class="w-32">
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold">Lista de FlashCards</h3>
                    <p class="text-sm text-gray-500 mb-4">"Listagem de flash cards (total)"</p>
                    <ul class="space-y-3">
                        <li class="flex items-center">
                            <span class="text-green-500 mr-2">✔</span> Scrumm
                        </li>
                        <li class="flex items-center">
                            <span class="text-green-500 mr-2">✔</span> Métodos Ágeis
                        </li>
                        <li class="flex items-center">
                            <span class="text-red-500 mr-2">⭕</span> Product Owner
                        </li>
                    </ul>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold">Lista de Diagramas</h3>
                    <p class="text-sm text-gray-500 mb-4">"Listagem de diagramas (total)"</p>
                    <ul class="space-y-3">
                        <li class="flex items-center">
                            <span class="text-green-500 mr-2">✔</span> Casos de Usos
                        </li>
                        <li class="flex items-center">
                            <span class="text-green-500 mr-2">✔</span> Fluxos de Dados
                        </li>
                        <li class="flex items-center">
                            <span class="text-red-500 mr-2">⭕</span> UML
                        </li>
                    </ul>
                </div>

            </div> </div>
    </div>
    </x-app-layout>