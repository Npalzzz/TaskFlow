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
    // DASHBOARD ADMIN
    // ==========================================

    public function index()
    {
        $totalUsers = User::count();

        $totalTasks = Task::count();

        $totalCategories = Category::count();

        $users = User::latest()
            ->take(5)
            ->get();

        $tasks = Task::with(['user', 'category'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalTasks',
            'totalCategories',
            'users',
            'tasks'
        ));
    }


    // ==========================================
    // CRUD USER - READ
    // ==========================================

    public function users()
    {
        $users = User::latest()->get();

        return view('admin.users.index', compact('users'));
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
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],

            'role' => [
                'required',
                'in:user,admin',
            ],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()
            ->route('admin.users')
            ->with('success', 'User berhasil ditambahkan.');
    }


    // ==========================================
    // CRUD USER - EDIT
    // ==========================================

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }


    // ==========================================
    // CRUD USER - UPDATE
    // ==========================================

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email,' . $user->id,
            ],

            'role' => [
                'required',
                'in:user,admin',
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];

        // Password hanya diubah kalau admin mengisi password baru
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()
            ->route('admin.users')
            ->with('success', 'Data user berhasil diperbarui.');
    }


    // ==========================================
    // CRUD USER - DELETE
    // ==========================================

    public function destroyUser(User $user)
    {
        // Admin tidak boleh menghapus akun yang sedang digunakan
        if ($user->id === auth()->id()) {
            return redirect()
                ->route('admin.users')
                ->with('error', 'Kamu tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()
            ->route('admin.users')
            ->with('success', 'User berhasil dihapus.');
    }
}