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
             *
             * Karena create.blade.php tidak memiliki
             * checkbox reminder_enabled, maka setiap
             * task baru akan mendapatkan reminder.
             */
            'reminder_enabled' => true,

            /*
             * Menyimpan pilihan user:
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
        |
        | isDirty() WAJIB dilakukan sebelum save().
        |
        | Jika salah satu berubah:
        |
        | - deadline
        | - status
        | - reminder_enabled
        | - reminder_days
        |
        | maka reminder sebelumnya harus di-reset.
        |
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
        |
        | Jika deadline, status, atau pengaturan reminder
        | berubah, notification lama dihapus dan status
        | reminder di-reset.
        |
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
        |
        | Scheduler akan menganggap task belum pernah
        | mendapatkan reminder.
        |
        */

        $task->update([
            'deadline_reminder_sent_at' => null,
        ]);
    }


    /**
     * Menghapus tugas.
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
        | Hapus task
        |--------------------------------------------------------------------------
        */

        $task->delete();


        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tugas berhasil dihapus!');
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