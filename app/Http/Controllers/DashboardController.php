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
        | Ambil kategori milik user
        |--------------------------------------------------------------------------
        */

        $categories = Category::where('user_id', $user->id)
            ->orderBy('nama_kategori', 'asc')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Base Query Task
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
        | Task Selesai
        |--------------------------------------------------------------------------
        */

        $completedTasks = Task::where('user_id', $user->id)
            ->where('status', 'Selesai')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Deadline H-7
        |--------------------------------------------------------------------------
        */

        $today = Carbon::today();

        $sevenDaysFromNow = Carbon::today()->addDays(7);

        $dueSoonCount = Task::where('user_id', $user->id)
            ->where('status', '!=', 'Selesai')
            ->whereNotNull('deadline')
            ->whereDate('deadline', '>=', $today)
            ->whereDate('deadline', '<=', $sevenDaysFromNow)
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
            ->whereDate('deadline', '>=', $today)
            ->whereDate('deadline', '<=', $sevenDaysFromNow)
            ->orderBy('deadline', 'asc')
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Notification Centre
        |--------------------------------------------------------------------------
        |
        | Ambil 5 notification terbaru milik user.
        |
        */

        $notifications = $user->notifications()
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Unread Notifications
        |--------------------------------------------------------------------------
        |
        | Jumlah notification yang belum dibaca.
        |
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