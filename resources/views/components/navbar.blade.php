<nav>
    <ul class="flex flex-wrap gap-4 items-center">
        <li>
            <a href="{{ route('habits.index') }}" class="{{ Route::is('habits.index') ? 'font-bold underline' : '' }}
                font-bold text-lg border-r-2 border-habit-orange pr-2 hover:underline">
                Hoje
            </a> 
        </li>
        <li>
            <a href="{{ route('habits.history') }}" class="{{ Route::is('habits.history') ? 'font-bold underline' : '' }}
                font-bold text-lg border-r-2 border-habit-orange pr-2 hover:underline">
                Histórico
            </a> 
        </li>
        <li>
            <a href="{{ route('habits.calendar') }}" class="{{ Route::is('habits.calendar') ? 'font-bold underline' : '' }}
                font-bold text-lg border-r-2 border-habit-orange pr-2 hover:underline">
                Calendário
            </a> 
        </li>
        <li>
            <a href="{{ route('habits.settings') }}" class="{{ Route::is('habits.settings') ? 'font-bold underline' : '' }}
                font-bold text-lg border-habit-orange hover:underline">
                Gerenciar hábitos
            </a> 
        </li>
    </ul>
</nav>