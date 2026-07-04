<x-layout>
    <main class="max-w-5xl mx-auto py-10 px-4 min-h-[80vh] w-full">
        <h1 class="font-bold text-2xl text-center pt-35">
            Editar hábito
        </h1>

        <section class="bg-white max-w-150 mx-auto p-10 pb-6 border-2 mt-4">

            <form action="{{ route('habits.update', $habit->id) }}" method="post" class="flex flex-col">
                @csrf
                @method('PUT')

                <div class="flex flex-col gap-2 mb-2">
                    <label for="name" class="text-xl font-bold">
                        Nome do hábito
                    </label>
                    <input
                        type="text"
                        name="name"
                        placeholder="nome do seu hábito"
                        class="bg-white p-2 border-2 @error('name') border-red-500 @enderror"
                        value="{{ $habit->name }}"
                    >
                    @error('name')
                        <p class="text-red-500 text-sm">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <button type="submit" class="bg-habit-orange habit-shadow-lg habit-shadow-lg-btn border-2 p-2 cursor-pointer mt-1">
                    Confirmar
                </button>
            </form>
        </section>
    </main>
</x-layout>