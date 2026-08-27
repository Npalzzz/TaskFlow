<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // ==========================================
    // DASHBOARD ADMIN & STATISTIK SISTEM
    // ==========================================

    public function index()
    {
        // ==========================================
        // STATISTIK PENGGUNA
        // ==========================================

        $totalUsers = User::count();

        $totalAdmins = User::where('role', 'admin')->count();

        $totalRegularUsers = User::where('role', 'user')->count();

        $totalCategories = Category::count();


        // ==========================================
        // STATISTIK TASK
        // ==========================================

        $totalTasks = Task::count();

        $belumTasks = Task::where('status', 'belum')->count();

        $prosesTasks = Task::where('status', 'proses')->count();

        $selesaiTasks = Task::where('status', 'selesai')->count();


        // ==========================================
        // TASK MENDEKATI DEADLINE
        // H-7 SAMPAI DEADLINE
        // ==========================================

        $dueSoonTasks = Task::where('status', '!=', 'selesai')
            ->whereNotNull('deadline')
            ->whereBetween('deadline', [
                now(),
                now()->addDays(7)
            ])
            ->count();


        // ==========================================
        // TASK TERLAMBAT
        // ==========================================

        $overdueTasks = Task::where('status', '!=', 'selesai')
            ->whereNotNull('deadline')
            ->where('deadline', '<', now())
            ->count();


        // ==========================================
        // STATISTIK PRIORITAS
        // ==========================================

        $rendahTasks = Task::where('priority', 'rendah')->count();

        $sedangTasks = Task::where('priority', 'sedang')->count();

        $tinggiTasks = Task::where('priority', 'tinggi')->count();


        // ==========================================
        // USER TERBARU
        // ==========================================

        $users = User::withCount('tasks')
            ->latest()
            ->take(5)
            ->get();


        // ==========================================
        // TASK TERBARU
        // ==========================================

        $tasks = Task::with(['user', 'category'])
            ->latest()
            ->take(5)
            ->get();


        // ==========================================
        // KIRIM DATA KE DASHBOARD
        // ==========================================

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAdmins',
            'totalRegularUsers',
            'totalCategories',

            'totalTasks',
            'belumTasks',
            'prosesTasks',
            'selesaiTasks',

            'dueSoonTasks',
            'overdueTasks',

            'rendahTasks',
            'sedangTasks',
            'tinggiTasks',

            'users',
            'tasks'
        ));
    }


    // ==========================================
    // MONITORING SELURUH TASK
    // READ-ONLY
    // ==========================================

    public function monitorTasks(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $priority = $request->input('priority');


        $tasks = Task::with(['user', 'category'])

            // ==========================================
            // SEARCH
            // ==========================================

            ->when($search, function ($query, $search) {

                $query->where(function ($q) use ($search) {

                    $q->where('judul', 'like', '%' . $search . '%')

                        ->orWhere('deskripsi', 'like', '%' . $search . '%')

                        ->orWhereHas('user', function ($userQuery) use ($search) {

                            $userQuery
                                ->where('name', 'like', '%' . $search . '%')
                                ->orWhere('email', 'like', '%' . $search . '%');

                        })

                        ->orWhereHas('category', function ($categoryQuery) use ($search) {

                            $categoryQuery->where(
                                'nama_kategori',
                                'like',
                                '%' . $search . '%'
                            );

                        });

                });

            })


            // ==========================================
            // FILTER STATUS
            // ==========================================

            ->when($status, function ($query, $status) {

                $query->where('status', $status);

            })


            // ==========================================
            // FILTER PRIORITY
            // ==========================================

            ->when($priority, function ($query, $priority) {

                $query->where('priority', $priority);

            })


            ->latest()
            ->paginate(15)
            ->withQueryString();


        return view(
            'admin.tasks.monitoring',
            compact(
                'tasks',
                'search',
                'status',
                'priority'
            )
        );
    }


    // ==========================================
    // CRUD USER - READ
    // ==========================================

    public function users()
    {
        $users = User::withCount('tasks')
            ->latest()
            ->get();

        return view(
            'admin.users.index',
            compact('users')
        );
    }


    // ==========================================
    // CRUD USER - CREATE
    // ==========================================

    public function createUser()
    {
        return view('admin.users.create');
    }


    // ==========================================
    // CRUD USER - STORE
    // ==========================================

    public function storeUser(Request $request)
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email'
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed'
            ],

            'role' => [
                'required',
                'in:user,admin'
            ],

        ]);


        User::create([

            'name' => $validated['name'],

            'email' => $validated['email'],

            'password' => Hash::make(
                $validated['password']
            ),

            'role' => $validated['role'],

        ]);


        return redirect()
            ->route('admin.users')
            ->with(
                'success',
                'User berhasil ditambahkan.'
            );
    }


    // ==========================================
    // CRUD USER - EDIT
    // ==========================================

    public function editUser(User $user)
    {
        return view(
            'admin.users.edit',
            compact('user')
        );
    }


    // ==========================================
    // CRUD USER - UPDATE
    // ==========================================

    public function updateUser(
        Request $request,
        User $user
    ) {

        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email,' . $user->id
            ],

            'role' => [
                'required',
                'in:user,admin'
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed'
            ],

        ]);


        $user->name = $validated['name'];

        $user->email = $validated['email'];

        $user->role = $validated['role'];


        if (!empty($validated['password'])) {

            $user->password = Hash::make(
                $validated['password']
            );

        }


        $user->save();


        return redirect()
            ->route('admin.users')
            ->with(
                'success',
                'Data user berhasil diperbarui.'
            );
    }


    // ==========================================
    // CRUD USER - DELETE
    // ==========================================

    public function destroyUser(User $user)
    {
        if ($user->id === auth()->id()) {

            return redirect()
                ->route('admin.users')
                ->with(
                    'error',
                    'Kamu tidak dapat menghapus akun sendiri.'
                );

        }


        $user->delete();


        return redirect()
            ->route('admin.users')
            ->with(
                'success',
                'User berhasil dihapus.'
            );
    }
}