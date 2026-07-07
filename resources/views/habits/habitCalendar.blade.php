<x-layout>

    <main class="max-w-5xl mx-auto py-10 px-4 min-h-[80vh] w-full">

        <x-navbar />

        @php
            $firstDay   = $date->dayOfWeek;
            $daysInMonth = $date->daysInMonth;
            $daysInPreviousMonth = $date->copy()->subMonth()->daysInMonth;
            $totalCells = 42;
            $totalHabits = $habits->count();
        @endphp

        <div class="mt-8 max-w-3xl mx-auto">

            {{-- Cabeçalho --}}
            <div class="flex flex-col md:flex-row justify-between items-center gap-6 mb-8">

                <div class="bg-habit-orange border-2 border-black habit-shadow-lg px-5 py-3 font-bold text-xl">
                    {{ ucfirst($date->translatedFormat('F \d\e Y')) }}
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('habits.calendar', ['month' => $previous->month, 'year' => $previous->year]) }}"
                        class="w-12 h-12 flex items-center justify-center bg-white border-2 border-black habit-shadow-lg-btn habit-btn">
                        ←
                    </a>
                    <a href="{{ route('habits.calendar') }}"
                        class="px-5 h-12 flex items-center bg-habit-orange border-2 border-black habit-shadow-lg-btn font-bold habit-btn">
                        Hoje
                    </a>
                    <a href="{{ route('habits.calendar', ['month' => $next->month, 'year' => $next->year]) }}"
                        class="w-12 h-12 flex items-center justify-center bg-white border-2 border-black habit-shadow-lg-btn habit-btn">
                        →
                    </a>
                </div>

            </div>

            {{-- Calendário --}}
            <div class="overflow-hidden border-2 border-black habit-shadow-lg">

                {{-- Cabeçalho dos dias da semana --}}
                <div class="grid grid-cols-7 bg-[#fff5e6] border-b-2 border-black">
                    @foreach (['DOM','SEG','TER','QUA','QUI','SEX','SÁB'] as $week)
                        <div class="py-4 text-center font-bold text-habit-orange text-sm">{{ $week }}</div>
                    @endforeach
                </div>

                {{-- Dias --}}
                <div class="grid grid-cols-7">

                    {{-- Mês anterior --}}
                    @for ($i = $firstDay - 1; $i >= 0; $i--)
                        <div class="relative h-20 border border-neutral-300 bg-gray-100 text-gray-400">
                            <span class="absolute top-2 left-2 text-sm font-semibold">
                                {{ $daysInPreviousMonth - $i }}
                            </span>
                        </div>
                    @endfor

                    {{-- Mês atual --}}
                    @for ($day = 1; $day <= $daysInMonth; $day++)
                        @php
                            $dateObj        = \Carbon\Carbon::create($date->year, $date->month, $day)->startOfDay();
                            $dateKey        = $dateObj->toDateString();
                            $isFuture       = $dateObj->isFuture();
                            $isToday        = now()->day == $day && now()->month == $date->month && now()->year == $date->year;

                            // Hábitos que já existiam neste dia
                            $habitsForDay   = $habits->filter(fn($h) => $h->created_at->startOfDay()->lte($dateObj));
                            $hasHabitsForDay = !$isFuture && $habitsForDay->isNotEmpty();

                            $completedCount = $logsByDay[$dateKey] ?? 0;
                            $totalForDay    = $habitsForDay->count();
                            $percent        = $totalForDay > 0 ? round(($completedCount / $totalForDay) * 100) : 0;

                            // Lista para o modal (só hábitos que existiam naquele dia)
                            $dayHabits = $habitsForDay->map(function($habit) use ($dateKey) {
                                return [
                                    'name'      => $habit->name,
                                    'completed' => $habit->habitLogs->contains(fn($log) =>
                                        \Carbon\Carbon::parse($log->completed_at)->toDateString() === $dateKey
                                    ),
                                ];
                            });
                        @endphp

                        <button
                            @if ($hasHabitsForDay)
                                onclick="openModal({{ $day }}, {{ $date->month }}, {{ $date->year }}, {{ $percent }}, {{ $completedCount }}, {{ $totalForDay }}, {{ $dayHabits->values()->toJson() }})"
                            @endif
                            class="relative h-20 border border-neutral-300 bg-white transition flex flex-col {{ $hasHabitsForDay ? 'hover:bg-orange-50 cursor-pointer' : 'cursor-default' }}">

                            {{-- Número do dia --}}
                            <div class="px-2 pt-2 flex items-center justify-between w-full">
                                <span class="flex items-center justify-center w-7 h-7 rounded-full font-bold text-sm
                                    {{ $isToday ? 'bg-habit-orange border-2 border-black text-white' : '' }}">
                                    {{ $day }}
                                </span>

                                @if ($hasHabitsForDay && $completedCount > 0)
                                    <span class="text-xs font-bold text-habit-orange">{{ $percent }}%</span>
                                @endif
                            </div>

                            {{-- Barra de progresso --}}
                            @if ($hasHabitsForDay)
                                <div class="mt-auto px-2 pb-2 w-full">
                                    <div class="w-full h-1.5 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-full bg-habit-orange rounded-full transition-all duration-300"
                                            style="width: {{ $percent }}%">
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </button>
                    @endfor

                    {{-- Próximo mês --}}
                    @php $remaining = $totalCells - ($firstDay + $daysInMonth); @endphp
                    @for ($day = 1; $day <= $remaining; $day++)
                        <div class="relative h-20 border border-neutral-300 bg-gray-100 text-gray-400">
                            <span class="absolute top-2 left-2 text-sm font-semibold">{{ $day }}</span>
                        </div>
                    @endfor

                </div>
            </div>
        </div>

    </main>

    {{-- MODAL --}}
    <div id="day-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">

        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-black/40" onclick="closeModal()"></div>

        {{-- Card --}}
        <div class="relative z-10 bg-[#FFFDF8] border-2 border-black habit-shadow-lg w-full max-w-sm mx-4 p-6">

            {{-- Header --}}
            <div class="flex items-center justify-between mb-4">
                <h2 id="modal-title" class="font-bold text-xl"></h2>
                <button onclick="closeModal()" class="w-8 h-8 flex items-center justify-center border-2 border-black habit-shadow-lg-btn habit-btn font-bold text-lg leading-none">
                    ×
                </button>
            </div>

            {{-- Progresso --}}
            <div class="mb-5">
                <div class="flex justify-between items-center mb-1">
                    <span class="text-sm font-semibold text-gray-600">Progresso do dia</span>
                    <span id="modal-percent" class="text-sm font-bold text-habit-orange"></span>
                </div>
                <div class="w-full h-3 bg-gray-200 border border-black overflow-hidden">
                    <div id="modal-bar" class="h-full bg-habit-orange transition-all duration-500" style="width: 0%"></div>
                </div>
                <p id="modal-count" class="text-xs text-gray-500 mt-1"></p>
            </div>

            {{-- Lista de hábitos --}}
            <ul id="modal-habits" class="flex flex-col gap-2">
            </ul>

        </div>
    </div>

    <script>
        const monthNames = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];

        function openModal(day, month, year, percent, completed, total, habits) {
            document.getElementById('modal-title').textContent = `${day} de ${monthNames[month - 1]} de ${year}`;
            document.getElementById('modal-percent').textContent = `${percent}%`;
            document.getElementById('modal-bar').style.width = `${percent}%`;
            document.getElementById('modal-count').textContent = `${completed} de ${total} hábito${total > 1 ? 's' : ''} concluído${completed > 1 ? 's' : ''}`;

            const list = document.getElementById('modal-habits');
            list.innerHTML = '';

            habits.forEach(habit => {
                const li = document.createElement('li');
                li.className = `flex items-center gap-3 p-2 border-2 border-black ${habit.completed ? 'bg-[#FFDAAC]' : 'bg-white'}`;

                li.innerHTML = `
                    <input type="checkbox" class="accent-habit-orange w-5 h-5 cursor-default" ${habit.completed ? 'checked' : ''} disabled>
                    <span class="font-bold ${habit.completed ? 'line-through decoration-2 decoration-habit-orange text-black/40' : ''}">${habit.name}</span>
                `;
                list.appendChild(li);
            });

            document.getElementById('day-modal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('day-modal').classList.add('hidden');
            document.body.style.overflow = '';
        }

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeModal();
        });
    </script>

</x-layout>