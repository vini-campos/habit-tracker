<x-layout>
    <main class="habit-bg flex flex-col">

        {{-- Hero Section --}}
        <section class="flex-1 flex flex-col items-center justify-center gap-8 px-4 py-16">

            {{-- Headline --}}
            <h1 class="font-mono font-bold text-4xl md:text-6xl text-center leading-tight max-w-3xl">
                Veja seus hábitos<br>
                <span class="text-habit-orange">ganharem vida.</span>
            </h1>

            {{-- Subheadline --}}
            <p class="font-sans text-base md:text-lg text-center text-black/70 max-w-md leading-relaxed">
                Construa rotinas que ficam. Acompanhe cada dia, celebre cada sequência.
            </p>

            {{-- CTA Buttons --}}
            <div class="flex flex-wrap gap-4 items-center justify-center mt-2">
                <a href="{{ route('auth.register') }}"
                   class="habit-btn habit-shadow-lg-btn font-mono bg-habit-orange text-white px-6 py-3 text-sm">
                    Começar agora
                </a>
                <a href="{{ route('auth.login') }}"
                   class="habit-btn habit-shadow-lg-btn font-mono bg-white text-black px-6 py-3 text-sm">
                    Já tenho conta
                </a>
            </div>
        </section>
    </main>
</x-layout>