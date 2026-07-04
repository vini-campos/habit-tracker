<header class="bg-white border-b-2">
    <div class="max-w-7xl mx-auto flex items-center justify-between p-4">
        {{-- LOGO --}}
        <div class="flex items-center gap-2 font-bold">
            <a href="{{ route('habits.index') }}" class="habit-btn habit-shadow-lg-btn px-2 py-1 bg-habit-orange">
                HT
            </a>
            <p>
                Habit Tracker
            </p>
        </div>

        {{-- GITHUB --}}
        <div class="flex gap-2 items-center">
            @auth
            
                <form class="inline" action="{{ route('auth.logout') }}" method="post">
                    @csrf

                    <button type="submit" class="habit-shadow-lg-btn habit-btn p-2 border-2">
                        Sair
                    </button>
                </form>
            @endauth

            @guest
                <div class="flex gap-2">
                    <a href="{{ route('auth.login') }}" class="p-2 habit-shadow-lg-btn habit-btn">
                        Cadastrar
                    </a>

                    <a href="{{ route('auth.login') }}" class="p-2 border-2 habit-shadow-lg-btn bg-habit-orange habit-btn">
                        Logar
                    </a>
                </div>
            @endguest

            <a class="habit-btn habit-shadow-lg-btn p-2" href="https://github.com/vini-campos/habit-tracker">
                <x-icons.github />
            </a>
        </div>
    </div>
</header>