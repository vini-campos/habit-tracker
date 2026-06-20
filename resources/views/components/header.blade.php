<header class="bg-white border-b-2 flex items-center justify-between p-4">
    {{-- LOGO --}}
    <div>
        Logo
    </div>

    {{-- GITHUB --}}
    <div>
        Github

        @auth
        
            <form class="inline" action="{{ route('auth.logout') }}" method="post">
                @csrf

                <button type="submit" class="bg-white p-2 border-2">
                    Sair
                </button>
            </form>
        @endauth

        @guest
            <a href="{{ route('auth.login') }}" class="bg-white p-2 border-2">
                Login
            </a>
        @endguest
    </div>
</header>