<x-layout>
    <main class="max-w-5xl mx-auto py-10 px-4 min-h-[80vh] w-full">
        <x-navbar />

        <div>
            <x-tittle>Configurar hábitos</x-tittle>

            <ul class="flex flex-col gap-2 mt-3">
                @forelse ($habits as $item)
                    <li class="flex gap-2 items-center justify-between w-full">
                        <div class="habit-shadow-lg p-2 bg-[#FFDAAC] w-full">
                            <p class="font-bold text-lg">{{ $item->name }}</p>
                        </div>

                        <a class="bg-white p-2 habit-shadow-lg-btn" href="{{ route('habits.edit', $item->id) }}">
                            <x-icons.edit />
                        </a>

                        {{-- DELETE: substituiu o form pelo botão que abre o modal --}}
                        <button
                            onclick="openDeleteModal('{{ route('habits.destroy', $item) }}', '{{ $item->name }}')"
                            class="bg-red-500 habit-shadow-lg-btn text-white p-2 cursor-pointer">
                            <x-icons.trash />
                        </button>
                    </li>
                @empty
                    <p>Ainda não há nenhum hábito cadastrado.</p>
                    <a href="{{ route('habits.create') }}" class="p-2 border-2 habit-shadow-lg-btn bg-[#FFDAAC] habit-btn">
                        Adicionar hábito
                    </a>
                @endforelse
            </ul>
        </div>
    </main>

    {{-- Modal fora do main para o fixed funcionar corretamente --}}
    <x-modal.confirm-delete />

</x-layout>