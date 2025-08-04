<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PredictionController extends Controller
{
    /**
     * Menyediakan data transaksi pengeluaran mentah untuk diolah oleh JavaScript.
     */
    public function getTransactionData()
    {
        $user = Auth::user();

        // Ambil hanya data yang dibutuhkan: tanggal dan jumlah pengeluaran
        $transactions = $user->transactions()
            ->where('type', 'expense')
            ->select('date', 'amount')
            ->orderBy('date', 'asc') // Urutkan berdasarkan tanggal
            ->get();

        return response()->json($transactions);
    }
}
