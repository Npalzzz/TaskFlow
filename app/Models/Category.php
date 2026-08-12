<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    protected $fillable = [
        'user_id',
        'nama_kategori',
    ];

    /**
     * Category dimiliki oleh satu user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Category memiliki banyak task.
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}