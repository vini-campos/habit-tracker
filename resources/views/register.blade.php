<x-layout>
    <main class="py-10">
        <section class="bg-white max-w-150 mx-auto p-10 pb-6 border-2 mt-4">

            <h1 class="font-bold text-3xl mb-4">
                Registre-se
            </h1>

            <p class="mb-4">
                Preencha as informações para se cadastrar
            </p>

            <form action="{{ route('auth.register') }}" method="post" class="flex flex-col">
                <!-- Middleware que valida o form (obrigatorio) -->
                @csrf

                <div class="flex flex-col gap-2 mb-2">
                    <label for="nome">
                        Nome
                    </label>

                    <input
                        type="text" 
                        name="nome" 
                        placeholder="Seu nome" 
                        class="bg-white p-2.5 text-sm habit-shadow focus:outline-none @error('nome') border-red-500 @enderror"
                    >

                    @error('nome')
                        <p class="text-red-500 text-sm">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-2 mb-2">
                    <label for="email">
                        Email
                    </label>

                    <input
                        type="email" 
                        name="email" 
                        placeholder="Email" 
                        class="bg-white p-2.5 text-sm habit-shadow focus:outline-none @error('email') border-red-500 @enderror"
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
                        class="bg-white p-2.5 text-sm habit-shadow focus:outline-none @error('password') border-red-500 @enderror"
                    >

                    @error('password')
                        <p class="text-red-500 text-sm">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-2 mb-4">
                    <label for="password_confirmation">
                        Repita sua senha
                    </label>

                    <input
                        type="password" 
                        name="password_confirmation" 
                        placeholder="**********" 
                        class="bg-white p-2.5 text-sm habit-shadow focus:outline-none @error('password') border-red-500 @enderror"
                    >

                    @error('password')
                        <p class="text-red-500 text-sm">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <button type="submit" class="mt-1 p-3 bg-habit-orange habit-shadow-lg-btn habit-btn text-sm uppercase tracking-widest">
                    Cadastrar-se
                </button>
            </form>
            <p class="text-center text-sm text-gray-500 mt-6">
                Já tem uma conta?
                <a href="{{ route('login') }}" class="font-bold text-black underline underline-offset-2 hover:opacity-60 transition">
                    Faça login
                </a>
            </p>
        </section>
    </main>
</x-layout>