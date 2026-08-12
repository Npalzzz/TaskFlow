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
    public function index(Request $request)
    {
        $search = $request->input('search');

        $tasks = Task::with('category')
            ->where('user_id', auth()->id())
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('judul', 'like', '%' . $search . '%')
                        ->orWhere('deskripsi', 'like', '%' . $search . '%')
                        ->orWhereHas('category', function ($categoryQuery) use ($search) {
                            $categoryQuery->where(
                                'nama_kategori',
                                'like',
                                '%' . $search . '%'
                            );
                        });
                });
            })
            ->latest()
            ->get();

        return view('tasks.index', compact('tasks', 'search'));
    }


    /**
     * Menampilkan form tambah tugas.
     */
    public function create()
    {
        // Hanya mengambil kategori milik user yang sedang login.
        $categories = Category::where('user_id', auth()->id())
            ->orderBy('nama_kategori', 'asc')
            ->get();

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
            'category_id' => [
                'required',
                'exists:categories,id,user_id,' . auth()->id(),
            ],
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

        // Hanya kategori milik user yang sedang login.
        $categories = Category::where('user_id', auth()->id())
            ->orderBy('nama_kategori', 'asc')
            ->get();

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
            'category_id' => [
                'required',
                'exists:categories,id,user_id,' . auth()->id(),
            ],
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