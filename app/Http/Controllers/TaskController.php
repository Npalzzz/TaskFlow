<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Menampilkan semua tugas milik user yang sedang login.
     */
    public function index()
    {
        $tasks = Task::with('category')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Menampilkan form tambah tugas.
     */
    public function create()
    {
        $categories = Category::all();

        return view('tasks.create', compact('categories'));
    }

    /**
     * Menyimpan tugas baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => ['required', 'max:255'],
            'deskripsi' => ['nullable'],
            'category_id' => ['required', 'exists:categories,id'],
            'deadline' => ['required', 'date'],
            'priority' => ['required'],
            'status' => ['required'],
        ]);

        Task::create([
            'user_id' => auth()->id(),
            'category_id' => $validated['category_id'],
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'deadline' => $validated['deadline'],
            'priority' => $validated['priority'],
            'status' => $validated['status'],
            'reminder_enabled' => true,
            'reminder_days' => 1,
        ]);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tugas berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail tugas.
     */
    public function show(Task $task)
    {
        $this->checkTaskOwner($task);

        $task->load('category');

        return view('tasks.show', compact('task'));
    }

    /**
     * Menampilkan form edit tugas.
     */
    public function edit(Task $task)
    {
        $this->checkTaskOwner($task);

        $categories = Category::all();

        return view('tasks.edit', compact('task', 'categories'));
    }

    /**
     * Memperbarui tugas.
     */
    public function update(Request $request, Task $task)
    {
        $this->checkTaskOwner($task);

        $validated = $request->validate([
            'judul' => ['required', 'max:255'],
            'deskripsi' => ['nullable'],
            'category_id' => ['required', 'exists:categories,id'],
            'deadline' => ['required', 'date'],
            'priority' => ['required'],
            'status' => ['required'],
        ]);

        $task->update([
            'category_id' => $validated['category_id'],
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'deadline' => $validated['deadline'],
            'priority' => $validated['priority'],
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('tasks.show', $task)
            ->with('success', 'Tugas berhasil diperbarui!');
    }

    /**
     * Menghapus tugas.
     */
    public function destroy(Task $task)
    {
        $this->checkTaskOwner($task);

        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tugas berhasil dihapus!');
    }

    /**
     * Memastikan tugas hanya bisa diakses pemiliknya.
     */
    private function checkTaskOwner(Task $task): void
    {
        abort_unless(
            (int) $task->user_id === (int) auth()->id(),
            403
        );
    }
}