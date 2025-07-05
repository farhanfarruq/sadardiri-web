<?php

namespace App\Http\Controllers;

use App\Models\HabitLog;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        // Ambil data transaksi dan tambahkan tipe 'transaction'
        // Eager load relasi 'category' untuk efisiensi
        $transactions = Transaction::where('user_id', $user->id)
            ->with('category')
            ->get()
            ->map(function ($item) {
                $item->activity_type = 'transaction';
                $item->activity_date = $item->date;
                return $item;
            });

        // Ambil data log kebiasaan dan tambahkan tipe 'habit'
        // Eager load relasi 'habit' untuk efisiensi
        $habitLogs = HabitLog::where('user_id', $user->id)
            ->with('habit')
            ->get()
            ->map(function ($item) {
                $item->activity_type = 'habit';
                $item->activity_date = $item->date;
                return $item;
            });

        // Gabungkan kedua koleksi, urutkan berdasarkan tanggal terbaru, dan paginasi
        $history = $transactions->concat($habitLogs)->sortByDesc('activity_date');

        return view('reports.index', compact('history'));
    }
}
