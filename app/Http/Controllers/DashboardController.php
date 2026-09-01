<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Default Category
        |--------------------------------------------------------------------------
        */

        $defaultCategories = [
            'Sekolah',
            'Pribadi',
            'Proyek',
        ];

        foreach ($defaultCategories as $namaKategori) {
            Category::firstOrCreate([
                'user_id' => $user->id,
                'nama_kategori' => $namaKategori,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        $search = trim($request->input('search', ''));

        /*
        |--------------------------------------------------------------------------
        | Sorting
        |--------------------------------------------------------------------------
        */

        $sort = $request->input('sort', 'latest');

        if (!in_array($sort, ['latest', 'deadline'])) {
            $sort = 'latest';
        }

        /*
        |--------------------------------------------------------------------------
        | Category Filter
        |--------------------------------------------------------------------------
        */

        $category = $request->input('category', 'all');

        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */

        $categories = Category::where('user_id', $user->id)
            ->orderBy('nama_kategori', 'asc')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Task Query
        |--------------------------------------------------------------------------
        */

        $taskQuery = Task::with('category')
            ->where('user_id', $user->id);

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($search !== '') {
            $taskQuery->where(function ($query) use ($search) {
                $query->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Category Filter
        |--------------------------------------------------------------------------
        */

        if ($category !== 'all' && is_numeric($category)) {

            $categoryExists = Category::where('id', $category)
                ->where('user_id', $user->id)
                ->exists();

            if ($categoryExists) {
                $taskQuery->where('category_id', $category);
            } else {
                $category = 'all';
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Sorting
        |--------------------------------------------------------------------------
        */

        if ($sort === 'deadline') {

            $taskQuery
                ->orderByRaw(
                    'CASE WHEN deadline IS NULL THEN 1 ELSE 0 END'
                )
                ->orderBy('deadline', 'asc')
                ->orderBy('created_at', 'desc');

        } else {

            $taskQuery->orderBy('created_at', 'desc');
        }

        /*
        |--------------------------------------------------------------------------
        | Task Dashboard
        |--------------------------------------------------------------------------
        */

        $tasks = $taskQuery
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Total Task
        |--------------------------------------------------------------------------
        */

        $totalTasks = Task::where('user_id', $user->id)
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Completed Task
        |--------------------------------------------------------------------------
        */

        $completedTasks = Task::where('user_id', $user->id)
            ->where('status', 'Selesai')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Date Reference
        |--------------------------------------------------------------------------
        */

        $today = Carbon::today();

        $sevenDaysFromNow = Carbon::today()
            ->addDays(7);

        /*
        |--------------------------------------------------------------------------
        | Deadline H-7
        |--------------------------------------------------------------------------
        */

        $dueSoonCount = Task::where('user_id', $user->id)
            ->where('status', '!=', 'Selesai')
            ->whereNotNull('deadline')
            ->whereBetween('deadline', [
                $today->startOfDay(),
                $sevenDaysFromNow->endOfDay()
            ])
            ->count();

        /*
        |--------------------------------------------------------------------------
        | OVERDUE TASK
        |--------------------------------------------------------------------------
        |
        | Mengambil maksimal 5 task yang sudah melewati deadline.
        |
        */

        $overdueTasks = Task::with('category')
            ->where('user_id', $user->id)
            ->where('status', '!=', 'Selesai')
            ->whereNotNull('deadline')
            ->where('deadline', '<', $today->startOfDay())
            ->orderBy('deadline', 'asc')
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Jumlah Task Overdue
        |--------------------------------------------------------------------------
        */

        $overdueCount = Task::where('user_id', $user->id)
            ->where('status', '!=', 'Selesai')
            ->whereNotNull('deadline')
            ->where('deadline', '<', $today->startOfDay())
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Task Prioritas Deadline
        |--------------------------------------------------------------------------
        */

        $priorityTasks = Task::with('category')
            ->where('user_id', $user->id)
            ->where('status', '!=', 'Selesai')
            ->whereNotNull('deadline')
            ->whereBetween('deadline', [
                $today->startOfDay(),
                $sevenDaysFromNow->endOfDay()
            ])
            ->orderBy('deadline', 'asc')
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Notification Centre
        |--------------------------------------------------------------------------
        */

        $notifications = $user->notifications()
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Unread Notifications
        |--------------------------------------------------------------------------
        */

        $unreadNotificationsCount = $user
            ->unreadNotifications()
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Return Dashboard
        |--------------------------------------------------------------------------
        */

        return view('dashboard', compact(
            'tasks',
            'totalTasks',
            'completedTasks',
            'dueSoonCount',
            'overdueCount',
            'overdueTasks',
            'priorityTasks',
            'search',
            'sort',
            'categories',
            'category',
            'notifications',
            'unreadNotificationsCount'
        ));
    }
}

