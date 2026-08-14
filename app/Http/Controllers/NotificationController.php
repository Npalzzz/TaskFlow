<?php

namespace App\Http\Controllers;

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
        $notifications = auth()->user()
            ->notifications()
            ->latest()
            ->get();

        $unreadCount = auth()->user()
            ->unreadNotifications()
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
            });


        return response()->json([
            'notifications' => $notifications,

            'unread_count' => $user
                ->unreadNotifications()
                ->count(),
        ]);
    }


    /**
     * Menandai satu notification sebagai sudah dibaca.
     */
    public function markAsRead(
        Request $request,
        DatabaseNotification $notification
    ): RedirectResponse {
        /*
        |--------------------------------------------------------------------------
        | Pastikan notification milik user yang sedang login
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $notification->notifiable_id === auth()->id()
            && $notification->notifiable_type === get_class(auth()->user()),
            403
        );


        /*
        |--------------------------------------------------------------------------
        | Tandai sebagai sudah dibaca
        |--------------------------------------------------------------------------
        */

        $notification->markAsRead();


        /*
        |--------------------------------------------------------------------------
        | Jika notification berasal dari TaskDeadlineReminder,
        | arahkan user langsung ke task tersebut.
        |--------------------------------------------------------------------------
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
        |--------------------------------------------------------------------------
        | Pastikan notification milik user yang sedang login
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $notification->notifiable_id === auth()->id()
            && $notification->notifiable_type === get_class(auth()->user()),
            403
        );


        /*
        |--------------------------------------------------------------------------
        | Tandai sebagai sudah dibaca
        |--------------------------------------------------------------------------
        */

        $notification->markAsRead();


        return response()->json([
            'success' => true,

            'unread_count' => auth()->user()
                ->unreadNotifications()
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