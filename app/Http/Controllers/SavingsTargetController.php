<?php

namespace App\Http\Controllers;

use App\Models\SavingsTarget;
use Illuminate\Http\Request;
use Carbon\Carbon; // Pastikan Carbon di-import

class SavingsTargetController extends Controller
{
    public function index()
    {
        $savingsTargets = auth()->user()->savingsTargets()->latest()->get();
        return view('savings_targets.index', compact('savingsTargets'));
    }

    public function create()
    {
        return view('savings_targets.create');
    }

    /**
     * PERBAIKAN DI SINI
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:1',
            'current_amount' => 'nullable|numeric|min:0',
            'target_date' => 'nullable|date|after:today',
            'description' => 'nullable|string',
        ]);

        // Menambahkan start_date secara otomatis dengan tanggal hari ini
        $validated['start_date'] = Carbon::now();

        auth()->user()->savingsTargets()->create($validated);

        return redirect()->route('savings-targets.index')->with('success', 'Target tabungan berhasil dibuat!');
    }

    public function show(SavingsTarget $savingsTarget)
    {
        if (auth()->user()->id !== $savingsTarget->user_id) {
            abort(403);
        }
        return view('savings_targets.show', compact('savingsTarget'));
    }

    public function edit(SavingsTarget $savingsTarget)
    {
        if (auth()->user()->id !== $savingsTarget->user_id) {
            abort(403);
        }
        return view('savings_targets.edit', compact('savingsTarget'));
    }

    public function update(Request $request, SavingsTarget $savingsTarget)
    {
        if (auth()->user()->id !== $savingsTarget->user_id) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:1',
            'current_amount' => 'nullable|numeric|min:0',
            'target_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        // Kita tidak perlu mengubah start_date saat update
        $savingsTarget->update($validated);

        return redirect()->route('savings-targets.index')->with('success', 'Target tabungan berhasil diperbarui.');
    }

    public function destroy(SavingsTarget $savingsTarget)
    {
        if (auth()->user()->id !== $savingsTarget->user_id) {
            abort(403);
        }
        
        $savingsTarget->delete();

        return redirect()->route('savings-targets.index')->with('success', 'Target tabungan berhasil dihapus.');
    }
}
