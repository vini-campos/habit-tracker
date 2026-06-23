<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Habit extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'name', 
    ];

    // um habito pertence a um usuario
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // um habito pode ter mais de 1 registro
    public function habitLog(): HasMany
    {
        return $this->hasMany(HabitLog::class);
    }
}
