<x-guest-layout>
 
    <div class="w-full max-w-4xl mx-auto my-10 px-6 py-8 bg-white border border-gray-200 shadow-md sm:rounded-lg">

        <h1 class="text-2xl text-center text-black mb-6">Registre-se</h1>

        <div class="flex flex-col md:flex-row items-start md:items-center gap-6">

            <!-- Form container -->
            <div class="flex-1 bg-white shadow-md border border-gray-200 overflow-hidden rounded-lg p-6">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label class="text-black"  for="name" :value="__('Nome completo:')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email:')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Username -->
                    <div class="mt-4">
                        <x-input-label class="text-black"  for="username" :value="__('Usuário:')" />
                        <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                    </div>

                    <!-- Date of birth -->
                    <div class="mt-4">
                        <x-input-label for="date_of_birth" :value="__('Data de Nascimento:')" />
                        <x-text-input id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth" :value="old('date_of_birth')" required />
                        <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Senha:')" />

                        <x-text-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirmar Senha:')" />

                        <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                        type="password"
                                        name="password_confirmation" required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    
                    <div class="flex items-center justify-center mt-6">
                        <x-primary-button class="w-full sm:w-auto">
                            {{ __('Criar conta') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <!-- Image container -->
            <div class="w-full md:w-80 flex-shrink-0 rounded-lg overflow-hidden flex items-center justify-center">
                <img class="w-full h-auto max-h-80 object-contain" src="/img/coruja-apresentadora-registro.svg" alt="Imagem do mascote do site">
            </div>

        </div>

    </div>

</x-guest-layout>