<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Category;

class Task extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'judul',
        'deskripsi',
        'deadline',
        'priority',
        'status',
        'reminder_enabled',
        'reminder_days',
        'deadline_reminder_sent_at',
    ];


    /**
     * Casting tipe data Task.
     */
    protected $casts = [
        'deadline' => 'date',
        'reminder_enabled' => 'boolean',
        'reminder_days' => 'integer',
        'deadline_reminder_sent_at' => 'datetime',
    ];


    /**
     * Relasi ke User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Relasi ke Category.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}