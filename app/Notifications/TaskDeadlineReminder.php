<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TaskDeadlineReminder extends Notification
{
    use Queueable;


    /**
     * Task yang akan dikirimkan reminder.
     */
    public function __construct(
        public Task $task
    ) {
    }


    /**
     * Menentukan channel notification.
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }


    /**
     * Data yang disimpan ke database.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'task_id' => $this->task->id,

            'judul' => $this->task->judul,

            'deadline' => $this->task->deadline
                ? $this->task->deadline->format('Y-m-d')
                : null,

            'reminder_days' => $this->task->reminder_days,

            'message' => 'Tugas "' . $this->task->judul .
                '" akan mencapai deadline pada ' .
                ($this->task->deadline
                    ? $this->task->deadline->format('d M Y')   
                    : '-')
                . '.',
        ];
    }
}