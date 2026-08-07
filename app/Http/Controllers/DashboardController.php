<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $tasks = Task::with('category')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        $totalTasks = $tasks->count();

        $completedTasks = $tasks
            ->where('status', 'Selesai')
            ->count();

        $dueSoonCount = $tasks
            ->filter(function ($task) {
                return Carbon::parse($task->deadline)
                    ->isToday();
            })
            ->count();

        return view('dashboard', compact(
            'tasks',
            'totalTasks',
            'completedTasks',
            'dueSoonCount'
        ));
    }
}