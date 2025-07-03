<?php
namespace App\Http\Controllers;

use App\Models\Habit;
use App\Models\HabitLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HabitController extends Controller
{
    public function index()
    {
        $habits = auth()->user()->habits()
            ->where('is_active', true)
            ->with(['logs' => function ($query) {
                $query->whereDate('date', today());
            }])
            ->get();

        return view('habits.index', compact('habits'));
    }

    public function create()
    {
        return view('habits.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'required|string|max:10',
            'frequency' => 'required|in:daily,weekly,monthly',
            'target_count' => 'required|integer|min:1',
            'color' => 'required|string|size:7'
        ]);

        auth()->user()->habits()->create($validated);

        return redirect()->route('habits.index')
            ->with('success', 'Kebiasaan berhasil ditambahkan!');
    }

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

    public function edit(Habit $habit)
    {
        $this->authorize('update', $habit);
        return view('habits.edit', compact('habit'));
    }

    public function update(Request $request, Habit $habit)
    {
        $this->authorize('update', $habit);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'required|string|max:10',
            'frequency' => 'required|in:daily,weekly,monthly',
            'target_count' => 'required|integer|min:1',
            'color' => 'required|string|size:7'
        ]);

        $habit->update($validated);

        return redirect()->route('habits.index')
            ->with('success', 'Kebiasaan berhasil diperbarui!');
    }

    public function destroy(Habit $habit)
    {
        $this->authorize('delete', $habit);
        $habit->delete();

        return redirect()->route('habits.index')
            ->with('success', 'Kebiasaan berhasil dihapus!');
    }
    

    public function toggle(Habit $habit)
    {
        $this->authorize('update', $habit);
        
        $today = today();
        $existingLog = $habit->logs()->whereDate('date', $today)->first();

        if ($existingLog) {
            $existingLog->delete();
            $status = 'unmarked';
        } else {
            $habit->logs()->create([
                'user_id' => auth()->id(),
                'date' => $today,
                'count' => 1
            ]);
            $status = 'marked';
        }

        return response()->json([
            'status' => $status,
            'message' => $status === 'marked' ? 'Kebiasaan berhasil ditandai!' : 'Tanda berhasil dihapus!'
        ]);
    }

    
}