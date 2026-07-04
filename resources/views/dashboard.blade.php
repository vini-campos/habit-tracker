<x-layout>
    <main class="max-w-5xl mx-auto py-10 px-4 min-h-[80vh] w-full">

        {{-- NAVBAR --}}
        <x-navbar />

        {{-- CONTENT --}}
        <div class="flex flex-col gap-4 items-start">
            <x-tittle>
                {{ \Carbon\Carbon::now()->locale('pt_BR')->translatedFormat('l, d \d\e F') }}
            </x-tittle>

            <ul class="flex flex-col gap-2 w-full">
                @forelse ($habits as $item)
                    <li class="habit-shadow-lg p-2 bg-[#FFDAAC]">
                        <form action="{{ route('habits.toggle', $item->id) }}" method="post" class="flex gap-2 items-center" id="form-{{ $item->id }}">
                            @csrf
                            <input type="checkbox" class="accent-habit-orange w-5 h-5 cursor-pointer" {{ $item->wasCompletedToday() ? 'checked' : '' }}
                                onchange="document.getElementById('form-{{ $item->id }}').submit()">
                                
                            <p class="font-bold text-lg {{ $item->wasCompletedToday() ? 'line-through decoration-2 decoration-habit-orange text-black/35' : '' }}">
                                {{ $item->name }}
                            </p>
                        </form>
                    </li>
                @empty
                    <p>
                        Cadastre o seu primeiro hábito.
                    </p>

                    <a href="{{ route('habits.create') }}" class="p-2 border-2 habit-shadow-lg-btn bg-[#FFDAAC] habit-btn">
                        Adicionar hábito
                    </a>
                @endforelse
            </ul>

            @if ($habits->isNotEmpty())
                <a href="{{ route('habits.create') }}" class="p-2 border-2 habit-shadow-lg-btn bg-habit-orange habit-btn">
                    Adicionar
                </a>
            @endif
        </div>
    </main>
</x-layout>