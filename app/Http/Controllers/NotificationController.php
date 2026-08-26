<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class NotificationController extends Controller
{
    /**
     * Menampilkan semua notification milik user yang sedang login.
     */
    public function index(): View
    {
        $user = auth()->user();

        $notifications = $user
            ->notifications()
            ->latest()
            ->get()
            ->filter(function (DatabaseNotification $notification) {
                return $this->isRelevantNotification($notification);
            });

        $unreadCount = $user
            ->unreadNotifications()
            ->get()
            ->filter(function (DatabaseNotification $notification) {
                return $this->isRelevantNotification($notification);
            })
            ->count();

        return view('notifications.index', compact(
            'notifications',
            'unreadCount'
        ));
    }


    /**
     * Mengambil notification terbaru untuk polling JavaScript.
     */
    public function latest(): JsonResponse
    {
        $user = auth()->user();

        $notifications = $user
            ->notifications()
            ->latest()
            ->take(10)
            ->get()
            ->filter(function (DatabaseNotification $notification) {
                return $this->isRelevantNotification($notification);
            })
            ->map(function (DatabaseNotification $notification) {

                return [
                    'id' => $notification->id,

                    'type' => $notification->type,

                    'task_id' => $notification->data['task_id'] ?? null,

                    'judul' => $notification->data['judul'] ?? 'Notifikasi',

                    'message' => $notification->data['message'] ?? '',

                    'deadline' => $notification->data['deadline'] ?? null,

                    'read_at' => $notification->read_at,

                    'created_at' => $notification->created_at?->toISOString(),
                ];
            })
            ->values();


        return response()->json([
            'notifications' => $notifications,

            'unread_count' => $user
                ->unreadNotifications()
                ->get()
                ->filter(function (DatabaseNotification $notification) {
                    return $this->isRelevantNotification($notification);
                })
                ->count(),
        ]);
    }


    /**
     * Mengecek apakah notification masih relevan untuk ditampilkan.
     *
     * Notification yang memiliki task_id dianggap sebagai
     * notification yang berhubungan dengan task.
     *
     * Jika task tersebut sudah selesai atau sudah dihapus,
     * notification tidak ditampilkan lagi.
     */
    private function isRelevantNotification(
        DatabaseNotification $notification
    ): bool {

        $taskId = $notification->data['task_id'] ?? null;

        /*
        |----------------------------------------------------------------------
        | Notification yang tidak berhubungan dengan task
        |----------------------------------------------------------------------
        |
        | Notification lain tetap ditampilkan.
        |
        */

        if (!$taskId) {
            return true;
        }


        /*
        |----------------------------------------------------------------------
        | Cari task
        |----------------------------------------------------------------------
        */

        $task = Task::find($taskId);


        /*
        |----------------------------------------------------------------------
        | Task sudah tidak ada
        |----------------------------------------------------------------------
        |
        | Jika task sudah dihapus, notification deadline tersebut
        | tidak lagi relevan.
        |
        */

        if (!$task) {
            return false;
        }


        /*
        |----------------------------------------------------------------------
        | Pastikan task masih aktif
        |----------------------------------------------------------------------
        */

        return $task->status !== 'Selesai';
    }


    /**
     * Menandai satu notification sebagai sudah dibaca.
     */
    public function markAsRead(
        Request $request,
        DatabaseNotification $notification
    ): RedirectResponse {
        /*
        |----------------------------------------------------------------------
        | Pastikan notification milik user yang sedang login
        |----------------------------------------------------------------------
        */

        abort_unless(
            $notification->notifiable_id === auth()->id()
            && $notification->notifiable_type === get_class(auth()->user()),
            403
        );


        /*
        |----------------------------------------------------------------------
        | Tandai sebagai sudah dibaca
        |----------------------------------------------------------------------
        */

        $notification->markAsRead();


        /*
        |----------------------------------------------------------------------
        | Jika notification berasal dari TaskDeadlineReminder,
        | arahkan user langsung ke task tersebut.
        |----------------------------------------------------------------------
        */

        $taskId = $notification->data['task_id'] ?? null;

        if ($taskId) {
            return redirect()->route('tasks.show', $taskId);
        }


        return back();
    }


    /**
     * Menandai satu notification sebagai sudah dibaca
     * melalui AJAX/fetch tanpa reload halaman.
     */
    public function markAsReadAjax(
        DatabaseNotification $notification
    ): JsonResponse {
        /*
        |----------------------------------------------------------------------
        | Pastikan notification milik user yang sedang login
        |----------------------------------------------------------------------
        */

        abort_unless(
            $notification->notifiable_id === auth()->id()
            && $notification->notifiable_type === get_class(auth()->user()),
            403
        );


        /*
        |----------------------------------------------------------------------
        | Tandai sebagai sudah dibaca
        |----------------------------------------------------------------------
        */

        $notification->markAsRead();


        return response()->json([
            'success' => true,

            'unread_count' => auth()->user()
                ->unreadNotifications()
                ->get()
                ->filter(function (DatabaseNotification $notification) {
                    return $this->isRelevantNotification($notification);
                })
                ->count(),
        ]);
    }


    /**
     * Menandai semua notification sebagai sudah dibaca.
     */
    public function markAllAsRead(): RedirectResponse
    {
        auth()->user()
            ->unreadNotifications
            ->markAsRead();

        return back()->with(
            'success',
            'Semua notifikasi telah ditandai sebagai sudah dibaca.'
        );
    }
}