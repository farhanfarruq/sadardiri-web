<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = auth()->user()->transactions()->with('category')->latest('date')->paginate(10);
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $categories = Category::orderBy('type')->orderBy('name')->get();
        return view('transactions.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date',
            'type' => 'required|in:income,expense',
            'notes' => 'nullable|string',
        ]);
        auth()->user()->transactions()->create($validated);
        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    /**
     * FUNGSI BARU: Menampilkan detail satu transaksi.
     */
    public function show(Transaction $transaction)
    {
        // Memastikan pengguna hanya bisa melihat transaksinya sendiri
        if (auth()->user()->id !== $transaction->user_id) {
            abort(403, 'AKSES DITOLAK');
        }
        return view('transactions.show', compact('transaction'));
    }

    /**
     * FUNGSI BARU: Menampilkan form untuk edit transaksi.
     */
    public function edit(Transaction $transaction)
    {
        // Memastikan pengguna hanya bisa mengedit transaksinya sendiri
        if (auth()->user()->id !== $transaction->user_id) {
            abort(403, 'AKSES DITOLAK');
        }
        $categories = Category::orderBy('type')->orderBy('name')->get();
        return view('transactions.edit', compact('transaction', 'categories'));
    }

    /**
     * FUNGSI BARU: Memperbarui data transaksi.
     */
    public function update(Request $request, Transaction $transaction)
    {
        if (auth()->user()->id !== $transaction->user_id) {
            abort(403, 'AKSES DITOLAK');
        }
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date',
            'type' => 'required|in:income,expense',
            'notes' => 'nullable|string',
        ]);
        $transaction->update($validated);
        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    /**
     * FUNGSI BARU: Menghapus data transaksi.
     */
    public function destroy(Transaction $transaction)
    {
        if (auth()->user()->id !== $transaction->user_id) {
            abort(403, 'AKSES DITOLAK');
        }
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
