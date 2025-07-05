<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Habit extends Model
{
    protected $fillable = [
        'user_id', 'name', 'description', 'icon', 'frequency', 
        'target_count', 'color', 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function logs(): HasMany
    {
        return $this->hasMany(HabitLog::class);
    }

    public function getCompletionPercentage($startDate = null, $endDate = null)
    {
        $startDate = $startDate ?? Carbon::now()->startOfMonth();
        $endDate = $endDate ?? Carbon::now()->endOfMonth();

        $logsInPeriod = $this->logs()
            ->whereBetween('date', [$startDate, $endDate])
            ->count();

        if ($this->target_count <= 0) {
            return 0;
        }

        $percentage = ($logsInPeriod / $this->target_count) * 100;
        
        return min($percentage, 100); // Pastikan tidak lebih dari 100%
    }

    public function getCurrentStreak()
    {
        $logs = $this->logs()->where('date', '<=', today())->orderBy('date', 'desc')->pluck('date');
        
        if ($logs->isEmpty()) {
            return 0;
        }

        $streak = 0;
        $currentDate = today();

        // Cek apakah hari ini sudah dicatat. Jika belum, mulai dari kemarin.
        if (!$logs->contains(fn($date) => $date->isSameDay($currentDate))) {
            $currentDate->subDay();
        }

        foreach ($logs as $logDate) {
            if ($logDate->isSameDay($currentDate)) {
                $streak++;
                $currentDate->subDay();
            } elseif ($logDate->lt($currentDate)) {
                // Berhenti jika ada hari yang terlewat
                break;
            }
        }
        
        return $streak;
    }
}
