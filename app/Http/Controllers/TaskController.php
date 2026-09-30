<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use App\Notifications\TaskDeadlineReminder;
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

            'reminder_days' => [
                'required',
                'integer',
                'in:1,2,3,7',
            ],
        ]);

        Task::create([
            'user_id' => auth()->id(),

            'category_id' => $validated['category_id'],

            'judul' => $validated['judul'],

            'deskripsi' => $validated['deskripsi'] ?? null,

            'deadline' => $validated['deadline'],

            'priority' => $validated['priority'],

            'status' => $validated['status'],

            /*
             * Reminder otomatis aktif.
             */
            'reminder_enabled' => true,

            /*
             * Menyimpan pilihan reminder:
             * H-1, H-2, H-3, atau H-7.
             */
            'reminder_days' => $validated['reminder_days'],

            /*
             * Task baru belum pernah mendapatkan reminder.
             */
            'deadline_reminder_sent_at' => null,
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

            'reminder_days' => [
                'required',
                'integer',
                'in:1,2,3,7',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Update Task
        |--------------------------------------------------------------------------
        */

        $task->fill([
            'category_id' => $validated['category_id'],

            'judul' => $validated['judul'],

            'deskripsi' => $validated['deskripsi'] ?? null,

            'deadline' => $validated['deadline'],

            'priority' => $validated['priority'],

            'status' => $validated['status'],

            /*
             * Reminder selalu aktif karena form edit
             * tidak menyediakan checkbox untuk mematikannya.
             */
            'reminder_enabled' => true,

            /*
             * Simpan pilihan reminder baru.
             */
            'reminder_days' => $validated['reminder_days'],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Cek perubahan yang mempengaruhi reminder
        |--------------------------------------------------------------------------
        */

        $deadlineChanged = $task->isDirty('deadline');

        $statusChanged = $task->isDirty('status');

        $reminderChanged = $task->isDirty([
            'reminder_enabled',
            'reminder_days',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Simpan perubahan task
        |--------------------------------------------------------------------------
        */

        $task->save();


        /*
        |--------------------------------------------------------------------------
        | Sinkronisasi Deadline Reminder
        |--------------------------------------------------------------------------
        */

        if (
            $deadlineChanged ||
            $statusChanged ||
            $reminderChanged
        ) {
            $this->clearDeadlineReminder($task);
        }


        return redirect()
            ->route('tasks.show', $task)
            ->with('success', 'Tugas berhasil diperbarui!');
    }


    /**
     * Menghapus reminder deadline yang berhubungan dengan task.
     */
    private function clearDeadlineReminder(Task $task): void
    {
        /*
        |--------------------------------------------------------------------------
        | Hapus notification reminder dari database
        |--------------------------------------------------------------------------
        */

        $task->user
            ->notifications()
            ->where('type', TaskDeadlineReminder::class)
            ->whereJsonContains('data->task_id', $task->id)
            ->delete();


        /*
        |--------------------------------------------------------------------------
        | Reset status reminder
        |--------------------------------------------------------------------------
        */

        $task->update([
            'deadline_reminder_sent_at' => null,
        ]);
    }


    /**
     * Menampilkan tugas yang sudah di-soft delete.
     */
    public function trash()
    {
        $tasks = Task::onlyTrashed()
            ->with('category')
            ->where('user_id', auth()->id())
            ->latest('deleted_at')
            ->get();

        return view('tasks.trash', compact('tasks'));
    }


    /**
     * Mengembalikan tugas dari Trash.
     */
    public function restore($id)
    {
        $task = Task::onlyTrashed()
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        $task->restore();

        return redirect()
            ->route('tasks.trash')
            ->with('success', 'Tugas berhasil dipulihkan!');
    }


    /**
     * Menghapus tugas secara permanen.
     */
    public function forceDelete($id)
    {
        $task = Task::onlyTrashed()
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Hapus notification reminder jika masih ada.
        |--------------------------------------------------------------------------
        */

        $this->clearDeadlineReminder($task);

        /*
        |--------------------------------------------------------------------------
        | Hapus task secara permanen dari database.
        |--------------------------------------------------------------------------
        */

        $task->forceDelete();

        return redirect()
            ->route('tasks.trash')
            ->with('success', 'Tugas berhasil dihapus secara permanen!');
    }


    /**
     * Menghapus tugas.
     *
     * Karena Task menggunakan SoftDeletes,
     * $task->delete() hanya akan mengisi deleted_at.
     */
    public function destroy(Task $task)
    {
        $this->checkTaskOwner($task);


        /*
        |--------------------------------------------------------------------------
        | Hapus notification reminder sebelum task dihapus
        |--------------------------------------------------------------------------
        */

        $this->clearDeadlineReminder($task);


        /*
        |--------------------------------------------------------------------------
        | Soft Delete Task
        |--------------------------------------------------------------------------
        |
        | Karena model Task menggunakan SoftDeletes,
        | delete() tidak menghapus data secara permanen.
        |
        */

        $task->delete();


        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tugas berhasil dipindahkan ke sampah!');
    }


    /**
     * Memastikan tugas hanya bisa diakses oleh pemiliknya.
     */
    private function checkTaskOwner(Task $task): void
    {
        abort_unless(
            (int) $task->user_id === (int) auth()->id(),
            403
        );
    }
}