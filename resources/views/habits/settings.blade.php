<x-layout>
    <main class="max-w-5xl mx-auto py-10 px-4 min-h-[80vh] w-full">
        {{-- NAVBAR --}}
        <x-navbar />

        <div>
            <x-tittle>
                Configurar hábitos
            </x-tittle>

            <ul class="flex flex-col gap-2 mt-2">
                @forelse ($habits as $item)
                    <li class="flex gap-2 items-center justify-between w-full">
                        <div class="habit-shadow-lg p-2 bg-[#FFDAAC] w-full">
                            <p class="font-bold text-lg">
                                {{ $item->name }}
                            </p>
                        </div>
                        {{-- EDIT --}}
                        <a class="bg-white p-2 habit-shadow-lg-btn" href="{{ route('habits.edit', $item->id) }}">
                            <x-icons.edit />
                        </a>

                        {{-- DELETE --}}
                        <form action="{{ route('habits.destroy', $item) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 habit-shadow-lg-btn text-white p-2 cursor-pointer">
                                <x-icons.trash />
                            </button>
                        </form>
                    </li>
                @empty
                    <p>
                        Ainda não há nenhum hábito cadastrado
                    </p>
                    <a href="{{ route('habits.create') }}" class="bg-white p-2 border-2">
                        Adicione um novo hábito agora
                    </a>
                @endforelse
            </ul>
        </div>
    </main>
</x-layout>