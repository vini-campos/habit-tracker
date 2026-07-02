<?php

namespace App\Http\Controllers;

use App\Http\Requests\HabitRequest;
use App\Models\Habit;
use App\Models\HabitLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HabitController extends Controller
{
    public function index (): View
    {
        $habits = Auth::user()->habits;

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
        return view('habits.edit', compact('habit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Habit $habit)
    {
        if ($habit->user_id != Auth::user()->id)
        {
            abort(403, 'Esse hábito pertence a outro usuário'); 
        }

        $habit->update($request->all());

        return redirect()
            ->route('habits.index')
            ->with('success', 'Hábito atualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Habit $habit)
    {
        if ($habit->user_id != Auth::user()->id)
        {
            abort(403, 'Esse hábito pertence a outro usuário'); 
        }

        $habit->delete();

            return redirect()
                ->route('habits.index')
                ->with('success', 'Hábito removido');
    }

    public function settings()
    {
        $habits = Auth::user()->habits;

        return view('habits.settings', compact('habits'));
    }

    public function toggle(Habit $habit)
    {
        if ($habit->user_id != Auth::user()->id)
        {
            abort(403, 'Esse hábito pertence a outro usuário'); 
        }

        $today = Carbon::today()->toDateString();

        $log = HabitLog::query()
            ->where('habit_id', $habit->id)
            ->where('completed_at', $today)
            ->first();

        if($log)
        {
            $log->delete();
            $message = 'Hábito desmarcado.';
        }
        else
        {
            HabitLog::Create([
                'user_id' => Auth::user()->id,
                'habit_id' => $habit->id,
                'completed_at' => $today,
            ]);

            $message = 'Hábito concluído.';
        }

        return redirect()
            ->route('habits.index')
            ->with('success', $message);
    }
}
