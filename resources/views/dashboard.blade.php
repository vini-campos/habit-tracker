<x-layout>
    <main class="max-w-5xl mx-auto py-10 px-4 min-h-[80vh] w-full">

        {{-- NAVBAR --}}
        <x-navbar />

        {{-- CONTENT --}}
        <section class="max-w-5xl mx-auto mt-8 flex flex-col gap-6 items-start">

            <x-tittle>
                {{ \Carbon\Carbon::now()->locale('pt_BR')->translatedFormat('l, d \d\e F') }}
            </x-tittle>

            <ul class="flex flex-col gap-3 w-full">

                @forelse ($habits as $item)
                    <li class="habit-shadow-lg p-3 bg-[#FFDAAC] w-full">

                        <form
                            action="{{ route('habits.toggle', $item->id) }}"
                            method="post"
                            class="flex gap-3 items-center w-full"
                            id="form-{{ $item->id }}"
                        >
                            @csrf

                            <input
                                type="checkbox"
                                class="accent-habit-orange w-5 h-5 cursor-pointer shrink-0"
                                {{ $item->wasCompletedToday() ? 'checked' : '' }}
                                onchange="document.getElementById('form-{{ $item->id }}').submit()"
                            >

                            <p class="font-bold text-base md:text-lg break-all
                                {{ $item->wasCompletedToday()
                                    ? 'line-through decoration-2 decoration-habit-orange text-black/35'
                                    : ''
                                }}">
                                {{ $item->name }}
                            </p>

                        </form>

                    </li>

                @empty

                    <p class="text-gray-600">
                        Cadastre o seu primeiro hábito.
                    </p>

                    <a
                        href="{{ route('habits.create') }}"
                        class="px-4 py-2 border-2 habit-shadow-lg-btn bg-[#FFDAAC] habit-btn text-sm"
                    >
                        Adicionar hábito
                    </a>

                @endforelse

            </ul>


            @if ($habits->isNotEmpty())

                <a
                    href="{{ route('habits.create') }}"
                    class="px-4 py-2 border-2 habit-shadow-lg-btn bg-habit-orange habit-btn text-sm"
                >
                    Adicionar
                </a>

            @endif

        </section>

    </main>
</x-layout>