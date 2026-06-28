<x-layout>
    <main class="py-10">
        <h1 class="font-bold text-4xl text-center ">
            Dashboard
        </h1>

        <a href="{{ route('habit.create') }}" class="p-2 border-2 bg-white font-bold block">
            Adicionar hábito
        </a>

        @session('success')
            <div class="flex">
                <p class="bg-green-100 border-2 border-green-400 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </p>
            </div>
        @endsession

        <div>
            <h2 class="text-xl mt-4">
                Listagem dos hábitos
            </h2>

            <ul class="flex flex-col gap-2">
                @forelse ($habits as $item)
                    <li class="pl-4">
                        <div class="flex gap-2 items-center">
                            <p class="font-bold text-xl">
                                - {{ $item->name }}
                            </p>
                            <p>
                                [{{ $item->habitLog->count() }}]
                            </p>

                            <a class="bg-white p-1 hover:opacity-50" href="{{ route('habit.edit', $item->id) }}">
                                <x-icons.edit />
                            </a>

                            <form action="{{ route('habit.destroy', $item) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white p-1 hover:opacity-50 cursor-pointer">
                                    <x-icons.trash />
                                </button>
                            </form>
                        </div>
                    </li>
                    @empty
                        <p>
                            Ainda não há nenhum hábito cadastrado
                        </p>
                        <a href="{{ route('habit.create') }}" class="bg-white p-2 border-2">
                            Adicione um novo hábito agora
                        </a>  
                @endforelse
            </ul>
        </div>
    </main>
</x-layout>