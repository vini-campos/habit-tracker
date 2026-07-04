<x-layout>
    <main class="max-w-5xl mx-auto py-10 min-h-[calc(100vh-160px)] px-4">

        <x-navbar />

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
        <div>
            @forelse($habits as $habit)
                <x-contribution :$habit :year="$selectedYear"/>
            @empty
                <div>
                    <p class="text-black">
                        Nenhum hábito para exibir o histórico.
                    </p>
                    <a href="{{ route('habits.create') }}" class="underline">
                        Crie um novo hábito
                    </a>
                </div>
            @endforelse
        </div>
    </main>
</x-layout>