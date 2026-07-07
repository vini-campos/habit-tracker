<x-layout>
    <main class="w-full min-h-[80vh] py-10 px-4 flex flex-col items-center justify-center gap-4">

        <h1 class="text-3xl sm:text-5xl font-bold text-center">
            Erro | 500
        </h1>

        <p class="text-base sm:text-lg text-black/50 text-center">
            Erro do servidor
        </p>

        <a href="{{ route('site.index') }}"
            class="px-4 py-2 border-2 habit-shadow-lg-btn bg-habit-orange habit-btn text-sm sm:text-base">
            Voltar ao início
        </a>

    </main>
</x-layout>