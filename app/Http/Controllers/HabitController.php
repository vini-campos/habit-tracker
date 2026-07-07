<?php

namespace App\Http\Controllers;

use App\Http\Requests\HabitRequest;
use App\Models\Habit;
use App\Models\HabitLog;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HabitController extends Controller
{
    use AuthorizesRequests;

    public function index (): View
    {
        $habits = Auth::user()->habits()
        ->with(['habitLogs' => fn($q) => $q->whereDate('completed_at', today())])
        ->get();

        return view('dashboard', compact('habits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('habits.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HabitRequest $request)
    {
        $validated = $request->validated();

        Auth::user()->habits()->create($validated);

        return redirect()
            ->route('habits.index')
            ->with('success', 'Hábito criado com sucesso');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Habit $habit)
    {
        $this->authorize('update', $habit);

        return view('habits.edit', compact('habit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HabitRequest $request, Habit $habit)
    {
        $this->authorize('update', $habit);

        $habit->update($request->validated());

        return redirect()
            ->route('habits.index')
            ->with('success', 'Hábito atualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Habit $habit)
    {
        $this->authorize('delete', $habit);

        $habit->delete();

            return redirect()
                ->route('habits.index')
                ->with('warning', 'Hábito removido.');
    }

    public function settings()
    {
        $habits = Auth::user()->habits;

        return view('habits.settings', compact('habits'));
    }

    public function toggle(Habit $habit)
    {
        $this->authorize('toggle', $habit);

        $today = Carbon::today()->toDateString();

        $log = HabitLog::query()
            ->where('habit_id', $habit->id)
            ->whereDate('completed_at', $today)
            ->first();

        if($log)
        {
            $log->delete();
            $message = 'Hábito desmarcado.';
            $alert = 'warning';
        }
        else
        {
            HabitLog::Create([
                'user_id' => Auth::id(),
                'habit_id' => $habit->id,
                'completed_at' => $today,
            ]);

            $alert = 'success';
            $message = 'Hábito concluído.';
        }

        return redirect()
            ->route('habits.index')
            ->with($alert, $message);
    }

    public function history(?int $year = null): view
    {
        $selectedYear = $year ?? Carbon::now()->year;

        $firstLog = Auth::user()->habitsLog()->oldest('completed_at')->first();
        $firstYear = $firstLog ? Carbon::parse($firstLog->completed_at)->year : Carbon::now()->year;
        $availableYears = range($firstYear, Carbon::now()->year);

        if (!in_array($selectedYear, $availableYears))
        {
            abort(404, 'Ano inválido');   
        }

        $startDate = Carbon::create($selectedYear, 1, 1);
        $endDate = Carbon::create($selectedYear, 12, 31, 23, 59, 59);

        $habits = Auth::user()->habits()
            ->with(['habitLogs' => function($query) use ($startDate, $endDate){
                $query->whereBetween('completed_at', [$startDate, $endDate]);
            }])
            ->get();

        return view('habits.history', compact('habits', 'selectedYear' ,'availableYears'));
    }

    public function calendar(Request $request)
    {
        $year  = $request->integer('year', now()->year);
        $month = $request->integer('month', now()->month);
    
        $date = Carbon::create($year, $month, 1)->locale('pt_BR');
    
        $startOfMonth = $date->copy()->startOfMonth();
        $endOfMonth   = $date->copy()->endOfMonth();
    
        // Carrega todos os hábitos com os logs do mês atual
        $habits = Auth::user()->habits()
            ->with(['habitLogs' => fn($q) => $q->whereBetween('completed_at', [$startOfMonth, $endOfMonth])])
            ->get();
    
        // Agrupa por dia: ['2025-06-01' => 3, '2025-06-02' => 1, ...]
        $logsByDay = $habits->flatMap->habitLogs
            ->groupBy(fn($log) => Carbon::parse($log->completed_at)->toDateString())
            ->map->count();
    
        return view('habits.habitCalendar', [
            'date'      => $date,
            'previous'  => $date->copy()->subMonth(),
            'next'      => $date->copy()->addMonth(),
            'habits'    => $habits,
            'logsByDay' => $logsByDay,
        ]);
    }
}
