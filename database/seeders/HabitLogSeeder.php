<?php

namespace Database\Seeders;

use App\Models\Habit;
use App\Models\HabitLog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HabitLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $habits = Habit::all();

       foreach ($habits as $habit)
        {
            $dates = fake()->unique()->dateTimeBetween('-30 days', 'now');

            HabitLog::factory()->count(3)->create([
                'habit_id' => $habit->id,
                'user_id' => $habit->user_id,
            ]);
        }
    }
}