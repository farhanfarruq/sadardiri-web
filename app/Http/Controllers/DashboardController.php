<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::today();
        
        // --- Statistik Utama ---
        $totalHabits = $user->habits()->where('is_active', true)->count();
        $completedToday = $user->habitLogs()->whereDate('date', $today)->count();
        
        $monthlyIncome = $user->transactions()
            ->where('type', 'income')
            ->whereYear('date', $today->year)
            ->whereMonth('date', $today->month)
            ->sum('amount');
            
        $monthlyExpense = $user->transactions()
            ->where('type', 'expense')
            ->whereYear('date', $today->year)
            ->whereMonth('date', $today->month)
            ->sum('amount');

        // --- Daftar Kebiasaan Hari Ini ---
        $activeHabits = $user->habits()
            ->where('is_active', true)
            ->with('logs')
            ->get();

        // --- Transaksi Terakhir ---
        $recentTransactions = $user->transactions()
            ->with('category')
            ->latest('date')
            ->limit(5)
            ->get();

        // --- Data untuk Grafik Progres Mingguan ---
        $habitChartData = [];
        $habitChartLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $habitChartLabels[] = $date->format('D, j M');
            $habitChartData[] = $user->habitLogs()->whereDate('date', $date)->count();
        }

        return view('dashboard', compact(
            'totalHabits', 'completedToday', 'monthlyIncome', 
            'monthlyExpense', 'activeHabits', 'recentTransactions',
            'habitChartLabels', 'habitChartData'
        ));
    }
}
