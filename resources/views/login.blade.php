<x-layout>
    <main class="py-10">
        <section class="bg-white max-w-150 mx-auto p-10 pb-6 mt-4 habit-shadow-lg">

            <h1 class="font-black text-3xl mb-1 tracking-tight">
                Fazer login
            </h1>

            <p class="text-gray-500 text-sm mb-6">
                Insira seus dados para acessar sua conta
            </p>

            <form action="{{ route('auth.login') }}" method="post" class="flex flex-col gap-5">
                @csrf

                <div class="flex flex-col gap-1.5">
                    <label for="email" class="font-bold text-sm uppercase tracking-wide">
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
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

                <div class="flex flex-col gap-1.5">
                    <label for="password" class="font-bold text-sm uppercase tracking-wide">
                        Senha
                    </label>

                    <input
                        type="password"
                        id="password"
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

                <button
                    type="submit"
                    class="mt-1 p-3 bg-habit-orange habit-shadow-lg-btn habit-btn text-sm uppercase tracking-widest"
                >
                    Entrar
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6">
                Ainda não tem uma conta?
                <a href="{{ route('site.register') }}" class="font-bold text-black underline underline-offset-2 hover:opacity-60 transition">
                    Registre-se
                </a>
            </p>
        </section>
    </main>
</x-layout>