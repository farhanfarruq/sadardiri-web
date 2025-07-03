<?php
namespace App\Http\Controllers;

use App\Models\Habit;
use App\Models\Transaction;
use App\Models\SavingsTarget;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $today = Carbon::today();
        $thisMonth = Carbon::now()->startOfMonth();
        $thisMonthEnd = Carbon::now()->endOfMonth();

        // Habit Statistics
        $totalHabits = $user->habits()->where('is_active', true)->count();
        $completedToday = $user->habitLogs()->whereDate('date', $today)->count();
        
        // Financial Statistics
        $monthlyIncome = $user->transactions()
            ->where('type', 'income')
            ->whereBetween('date', [$thisMonth, $thisMonthEnd])
            ->sum('amount');
            
        $monthlyExpense = $user->transactions()
            ->where('type', 'expense')
            ->whereBetween('date', [$thisMonth, $thisMonthEnd])
            ->sum('amount');

        $savings = $monthlyIncome - $monthlyExpense;
        
        // Recent Transactions
        $recentTransactions = $user->transactions()
            ->with('category')
            ->latest()
            ->limit(5)
            ->get();

        // Active Habits
        $activeHabits = $user->habits()
            ->where('is_active', true)
            ->withCount(['logs' => function ($query) use ($today) {
                $query->whereDate('date', $today);
            }])
            ->get();

        return view('dashboard', compact(
            'totalHabits', 'completedToday', 'monthlyIncome', 
            'monthlyExpense', 'savings', 'recentTransactions', 
            'activeHabits'
        ));
    }
}