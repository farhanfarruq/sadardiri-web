<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use App\Models\HabitLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HabitController extends Controller
{
    /**
     * Menampilkan daftar semua kebiasaan milik pengguna.
     */
    public function index()
    {
        $habits = Auth::user()->habits()
            ->where('is_active', true)
            ->with('logs') // Eager load logs untuk efisiensi
            ->paginate(9); // Menggunakan paginate untuk penomoran halaman

        return view('habits.index', compact('habits'));
    }

    /**
     * Menampilkan form untuk membuat kebiasaan baru.
     */
    public function create()
    {
        return view('habits.create');
    }

    /**
     * Menyimpan kebiasaan baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'required|string|max:50', // Batas karakter dinaikkan
            'frequency' => 'required|in:daily,weekly,monthly',
            'target_count' => 'required|integer|min:1',
            'color' => 'required|string|size:7',
            'icon' => 'required|string|max:255'
        ]);

        Auth::user()->habits()->create($validated);

        return redirect()->route('habits.index')
            ->with('success', 'Kebiasaan berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail satu kebiasaan.
     */
    public function show(Habit $habit)
    {
        $this->authorize('view', $habit);
        
        $logs = $habit->logs()
            ->whereMonth('date', now()->month)
            ->orderBy('date', 'desc')
            ->get();

        $streak = $habit->getCurrentStreak();
        $monthlyCompletion = $habit->getCompletionPercentage(
            now()->startOfMonth(), 
            now()->endOfMonth()
        );

        return view('habits.show', compact('habit', 'logs', 'streak', 'monthlyCompletion'));
    }

    /**
     * Menampilkan form untuk mengedit kebiasaan.
     */
    public function edit(Habit $habit)
    {
        $this->authorize('update', $habit);
        return view('habits.edit', compact('habit'));
    }

    /**
     * Memperbarui kebiasaan di database.
     */
    public function update(Request $request, Habit $habit)
    {
        $this->authorize('update', $habit);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'required|string|max:50', // Batas karakter dinaikkan
            'frequency' => 'required|in:daily,weekly,monthly',
            'target_count' => 'required|integer|min:1',
            'color' => 'required|string|size:7',
            'icon' => 'required|string|max:255'
        ]);

        $habit->update($validated);

        return redirect()->route('habits.index')
            ->with('success', 'Kebiasaan berhasil diperbarui!');
    }

    /**
     * Menghapus kebiasaan dari database.
     */
    public function destroy(Habit $habit)
    {
        $this->authorize('delete', $habit);
        $habit->delete();

        return redirect()->route('habits.index')
            ->with('success', 'Kebiasaan berhasil dihapus!');
    }
    
    /**
     * Menandai kebiasaan sebagai selesai/belum selesai untuk hari ini.
     */
    public function toggle(Habit $habit)
    {
        $this->authorize('update', $habit);
        
        $today = today();
        $existingLog = $habit->logs()->whereDate('date', $today)->first();

        if ($existingLog) {
            $existingLog->delete();
        } else {
            $habit->logs()->create([
                'user_id' => Auth::id(),
                'date' => $today,
                'count' => 1
            ]);
        }
        
        return back()->with('success', 'Status kebiasaan diperbarui!');
    }
}
