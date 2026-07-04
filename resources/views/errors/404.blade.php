<x-layout>
    <main class="max-w-5xl mx-auto py-10 px-4 min-h-[80vh] w-full flex flex-col items-center justify-center gap-4">
        
        <h1 class="text-5xl font-bold">Erro | 404</h1>
        <p class="text-lg text-black/50">Página não encontrada</p>
        
        <a href="{{ route('site.index') }}" class="p-2 border-2 habit-shadow-lg-btn bg-habit-orange habit-btn">
            Voltar ao início
        </a>

    </main>
</x-layout>