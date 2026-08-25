<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,

            'judul' => $this->judul,
            'deskripsi' => $this->deskripsi,

            'deadline' => $this->deadline?->format('Y-m-d'),

            'priority' => $this->priority,
            'status' => $this->status,

            'reminder_enabled' => $this->reminder_enabled,
            'reminder_days' => $this->reminder_days,

            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}