<x-app-layout>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-4 text-sm text-gray-600">
                <a href="{{ route('aulas') }}" class="hover:underline">Aulas</a>
                <span class="mx-2">></span>
                <span>{{ $modulo['titulo'] }}</span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

                <div class="lg:col-span-1 bg-white shadow-sm sm:rounded-lg p-6 h-fit">
                    <h3 class="text-lg font-semibold mb-4">{{ $modulo['titulo'] }} Syllabus</h3>
                    <div class="lg:col-span-1 bg-white shadow-sm sm:rounded-lg p-6 h-fit">
                        <h3 class="text-lg font-semibold mb-4">{{ $modulo['titulo'] }} Syllabus</h3>
                        
                        <ul>
                            @foreach ($syllabus as $item)
                                <li>
                                    <a href="{{ route('aulas.show', ['id' => $item['id']]) }}" 
                                    class="block mb-2 p-2 rounded
                                            {{-- Lógica para destacar o link ativo --}}
                                            {{ $item['id'] == $modulo['id'] 
                                                ? 'bg-gray-200 font-bold text-black'  
                                                : 'hover:bg-gray-100 text-gray-700' }}">
                                        
                                        {{ $item['titulo'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="lg:col-span-2 bg-white shadow-sm sm:rounded-lg p-6">
                    <h2 class="text-2xl font-bold mb-4">Conteúdo do Módulo (ex: Vídeo ou Texto)</h2>
                    <div class="aspect-video bg-gray-900 text-white flex items-center justify-center rounded-lg">
                        <p>(Aqui ficará seu conteúdo escrito ou player de vídeo)</p>
                    </div>
                    <p class="mt-4">
                        Este é o espaço para o conteúdo principal da aula, como textos, imagens, ou um player de vídeo.
                    </p>
                </div>

                <div class="lg:col-span-1 bg-white shadow-sm sm:rounded-lg p-6 h-fit">
                    <h3 class="text-lg font-semibold mb-4">Chat (Assistente IA)</h3>
                    <div class="border rounded-lg h-96 flex flex-col">
                        <div class="flex-grow p-4 overflow-y-auto">
                            <div class="mb-2">
                                <span class="bg-gray-200 rounded-lg px-3 py-2 inline-block">Olá! Como posso ajudar?</span>
                            </div>
                        </div>
                        <div class="p-4 border-t">
                            <input type="text" placeholder="Digite sua mensagem..." class="w-full border-gray-300 rounded-lg shadow-sm">
                        </div>
                    </div>
                </div>

            </div>

            <div class="mt-8 bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Seu Progresso (Gamificação)</h3>
                <div class="flex justify-between items-center mb-2">
                    <span class="font-semibold">REWARDS BALANCE</span>
                </div>
                <div class="w-full bg-gray-300 rounded-full h-4">
                    <div class="bg-green-600 h-4 rounded-full" style="width: 62%"></div>
                </div>
                <div class="text-right mt-1 font-semibold">94 / 150 Pontos</div>
            </div>

        </div>
    </div>
</x-app-layout>