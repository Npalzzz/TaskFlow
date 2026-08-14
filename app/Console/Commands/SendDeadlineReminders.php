<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Notifications\TaskDeadlineReminder;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendDeadlineReminders extends Command
{
    protected $signature = 'tasks:send-deadline-reminders';

    protected $description = 'Mengirim notifikasi untuk task yang mendekati deadline';


    public function handle(): int
    {
        $today = Carbon::today();


        $tasks = Task::query()
            ->with('user')
            ->where('reminder_enabled', true)
            ->where('status', '!=', 'Selesai')
            ->whereNotNull('deadline')
            ->whereNull('deadline_reminder_sent_at')
            ->get();


        foreach ($tasks as $task) {

            if (! $task instanceof Task) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | Deadline
            |--------------------------------------------------------------------------
            */

            $deadline = Carbon::parse($task->deadline)
                ->startOfDay();


            /*
            |--------------------------------------------------------------------------
            | Tanggal reminder
            |--------------------------------------------------------------------------
            */

            $reminderDate = $deadline
                ->copy()
                ->subDays((int) $task->reminder_days)
                ->startOfDay();


            /*
            |--------------------------------------------------------------------------
            | Cek apakah sudah waktunya reminder
            |--------------------------------------------------------------------------
            */

            if (
                $today->greaterThanOrEqualTo($reminderDate)
                && $today->lessThanOrEqualTo($deadline)
            ) {

                /*
                |--------------------------------------------------------------------------
                | Pastikan task masih belum selesai
                |--------------------------------------------------------------------------
                */

                if ($task->status === 'Selesai') {
                    continue;
                }


                /*
                |--------------------------------------------------------------------------
                | Kirim notification
                |--------------------------------------------------------------------------
                */

                $task->user->notify(
                    new TaskDeadlineReminder($task)
                );


                /*
                |--------------------------------------------------------------------------
                | Tandai reminder sudah dikirim
                |--------------------------------------------------------------------------
                */

                $task->update([
                    'deadline_reminder_sent_at' => now(),
                ]);


                $this->info(
                    'Reminder dikirim: ' . $task->judul
                );
            }
        }


        return Command::SUCCESS;
    }
}