<x-layout>
    <main class="py-10 px-4">
        <section class="bg-white w-full max-w-md mx-auto mt-4 p-6 md:p-10 pb-6 habit-shadow-lg">

            <h1 class="font-black text-2xl md:text-3xl mb-1 tracking-tight">
                Registre-se
            </h1>

            <p class="text-gray-500 text-sm mb-6">
                Preencha as informações para criar sua conta
            </p>

            <form action="{{ route('auth.register') }}" method="post" class="flex flex-col gap-5">
                @csrf

                {{-- Nome --}}
                <div class="flex flex-col gap-1.5">
                    <label
                        for="nome"
                        class="font-bold text-sm uppercase tracking-wide"
                    >
                        Nome
                    </label>

                    <input
                        id="nome"
                        type="text"
                        name="nome"
                        placeholder="Seu nome"
                        value="{{ old('nome') }}"
                        class="bg-white p-2.5 text-sm habit-shadow focus:outline-none @error('nome') border-red-500 @enderror"
                    >

                    @error('nome')
                        <p class="text-red-500 text-xs font-semibold">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="flex flex-col gap-1.5">
                    <label
                        for="email"
                        class="font-bold text-sm uppercase tracking-wide"
                    >
                        Email
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        placeholder="seu@email.com"
                        value="{{ old('email') }}"
                        class="bg-white p-2.5 text-sm habit-shadow focus:outline-none @error('email') border-red-500 @enderror"
                    >

                    @error('email')
                        <p class="text-red-500 text-xs font-semibold">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Senha --}}
                <div class="flex flex-col gap-1.5">
                    <label
                        for="password"
                        class="font-bold text-sm uppercase tracking-wide"
                    >
                        Senha
                    </label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="••••••••••"
                        class="bg-white p-2.5 text-sm habit-shadow focus:outline-none @error('password') border-red-500 @enderror"
                    >

                    @error('password')
                        <p class="text-red-500 text-xs font-semibold">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Confirmar senha --}}
                <div class="flex flex-col gap-1.5">
                    <label
                        for="password_confirmation"
                        class="font-bold text-sm uppercase tracking-wide"
                    >
                        Confirmar senha
                    </label>

                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        placeholder="••••••••••"
                        class="bg-white p-2.5 text-sm habit-shadow focus:outline-none"
                    >
                </div>

                <button
                    type="submit"
                    class="mt-2 py-3 px-4 bg-habit-orange habit-shadow-lg-btn habit-btn text-sm uppercase tracking-widest"
                >
                    Cadastrar-se
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6 leading-relaxed">
                Já tem uma conta?
                <a
                    href="{{ route('login') }}"
                    class="font-bold text-black underline underline-offset-2 hover:opacity-60 transition"
                >
                    Faça login
                </a>
            </p>

        </section>
    </main>
</x-layout>