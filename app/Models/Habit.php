<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\Category;
use App\Models\HabitLog;


class Habit extends Model
{
    protected $fillable = [
        'user_id', 'name', 'description', 'icon', 'frequency', 
        'target_count', 'color', 'is_active'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function logs(): HasMany
    {
        return $this->hasMany(HabitLog::class);
    }

    public function getCompletionPercentage($startDate, $endDate)
    {
        $totalDays = $startDate->diffInDays($endDate) + 1;
        $completedDays = $this->logs()
            ->whereBetween('date', [$startDate, $endDate])
            ->count();
        
        return $totalDays > 0 ? ($completedDays / $totalDays) * 100 : 0;
    }

    public function getCurrentStreak()
    {
        $logs = $this->logs()
            ->orderBy('date', 'desc')
            ->get();
        
        $streak = 0;
        $currentDate = today();
        
        foreach ($logs as $log) {
            if ($log->date->eq($currentDate)) {
                $streak++;
                $currentDate = $currentDate->subDay();
            } else {
                break;
            }
        }
        
        return $streak;
    }

        public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

        public function habitLogs(): HasMany
    {
        return $this->hasMany(HabitLog::class);
    }

    public function habits()
{
    return $this->hasMany(Habit::class);
}
}