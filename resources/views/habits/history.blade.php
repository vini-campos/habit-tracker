<x-layout>
    <main class="max-w-5xl mx-auto py-10 min-h-[calc(100vh-160px)] px-4 w-full">

        <x-navbar />

        <x-tittle>
            Histórico
        </x-tittle>

        {{-- YEAR SELECTION --}}
        <div class="my-4">
            @foreach ($availableYears as $y)
                <a href="{{ route('habits.history', $y) }}"
                    class="habit-btn habit-shadow-lg-btn inline-block py-1 px-2 {{ $selectedYear == $y ? 'bg-habit-orange text-white' : 'bg-white' }}">
                    {{ $y }}
                </a>
            @endforeach
        </div>

        {{-- HISTORICO --}}
        <div class="flex flex-col gap-2 w-full">
            @forelse($habits as $habit)
                <x-contribution :$habit :year="$selectedYear"/>
            @empty
                <div class="flex flex-col gap-2 w-full">
                    <p class="text-black">
                        Nenhum hábito para exibir o histórico.
                    </p>

                    <a href="{{ route('habits.create') }}" class="p-2 border-2 habit-shadow-lg-btn bg-[#FFDAAC] habit-btn">
                        Adicionar hábito
                    </a>
                </div>
            @endforelse
        </div>
    </main>
</x-layout>