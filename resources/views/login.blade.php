<x-layout>
    <main class="py-10">
        <section class="bg-white max-w-150 mx-auto p-10 border-2 mt-4">

            <h1 class="font-bold text-3xl mb-4">
                Fazer login
            </h1>

            <p class="mb-4">
                Insira seus dados para acessar
            </p>

            <form action="/login" method="post" class="flex flex-col">
                <!-- Middleware que valida o form (obrigatorio) -->
                @csrf

                <div class="flex flex-col gap-2 mb-2">
                    <label for="email">
                        Email
                    </label>

                    <input
                        type="email" 
                        name="email" 
                        placeholder="Email" 
                        class="bg-white p-2 border-2 @error('email') border-red-500 @enderror"
                    >

                    @error('email')
                        <p class="text-red-500 text-sm">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                
                <div class="flex flex-col gap-2 mb-4">
                    <label for="password">
                        Senha
                    </label>

                    <input
                        type="password" 
                        name="password" 
                        placeholder="**********" 
                        class="bg-white p-2 border-2 @error('password') border-red-500 @enderror"
                    >

                    @error('password')
                        <p class="text-red-500 text-sm">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <button type="submit" class="bg-white border-2 p-2">
                    Entrar
                </button>
            </form>
        </section>
    </main>
</x-layout>